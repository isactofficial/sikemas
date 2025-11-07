<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles
     */
    public function index(Request $request)
    {
        $query = Article::with(['editor'])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sort by
        if ($request->has('sort_by')) {
            if ($request->sort_by === 'newest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort_by === 'oldest') {
                $query->orderBy('created_at', 'asc');
            } elseif ($request->sort_by === 'popular') {
                $query->orderBy('views', 'desc');
            }
        }

        $articles = $query->paginate(8);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('admin.articles.create', compact('users'));
    }

    /**
     * Store a newly created article
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255|unique:articles,title',
                'deskripsi' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'editor_id' => 'nullable|exists:users,id',
                'status' => 'required|in:draft,published',
                'subheadings' => 'nullable|array',
                'subheadings.*' => 'nullable|string',
                'paragraphs' => 'nullable|array',
                'paragraphs.*' => 'nullable|string',
            ], [
                'title.required' => 'Judul artikel wajib diisi.',
                'title.unique' => 'Artikel dengan judul ini sudah ada. Silakan gunakan judul lain.',
                'deskripsi.required' => 'Deskripsi artikel wajib diisi.',
                'thumbnail.image' => 'File harus berupa gambar.',
                'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
                'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
                'editor_id.exists' => 'Editor yang dipilih tidak valid.',
                'status.required' => 'Status artikel wajib dipilih.',
                'status.in' => 'Status artikel tidak valid.',
            ]);

            // Generate slug dari title
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $counter = 1;
            
            // Pastikan slug unique
            while (Article::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('articles/thumbnails', 'public');
            }

            // Create article
            $article = Article::create([
                'title' => $validated['title'],
                'slug' => $slug,
                'deskripsi' => $validated['deskripsi'],
                'thumbnail' => $thumbnailPath,
                'editor_id' => $validated['editor_id'] ?? auth()->id(),
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' ? now() : null,
            ]);

            // Save article contents
            $this->saveArticleContents($article, $request);

            return redirect()->route('admin.articles.index')
                ->with('success', 'Artikel berhasil ditambahkan!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan artikel. Periksa kembali data Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan artikel. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified article
     */
    public function show(Article $article)
    {
        $article->load(['contents', 'editor']);
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article
     */
    public function edit(Article $article)
    {
        $article->load(['contents']);
        $users = \App\Models\User::all();
        return view('admin.articles.edit', compact('article', 'users'));
    }

    /**
     * Update the specified article
     */
    public function update(Request $request, Article $article)
    {
        try {
            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('articles', 'title')->ignore($article->id)
                ],
                'deskripsi' => 'required|string',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'editor_id' => 'nullable|exists:users,id',
                'status' => 'required|in:draft,published',
                'subheadings' => 'nullable|array',
                'paragraphs' => 'nullable|array',
            ], [
                'title.required' => 'Judul artikel wajib diisi.',
                'title.unique' => 'Artikel dengan judul ini sudah ada. Silakan gunakan judul lain.',
                'deskripsi.required' => 'Deskripsi artikel wajib diisi.',
                'thumbnail.image' => 'File harus berupa gambar.',
                'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
                'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
                'editor_id.exists' => 'Editor yang dipilih tidak valid.',
                'status.required' => 'Status artikel wajib dipilih.',
                'status.in' => 'Status artikel tidak valid.',
            ]);

            // Update slug jika title berubah
            if ($request->title !== $article->title) {
                $slug = Str::slug($validated['title']);
                $originalSlug = $slug;
                $counter = 1;
                
                // Pastikan slug unique (kecuali untuk artikel ini sendiri)
                while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $article->slug = $slug;
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                    Storage::disk('public')->delete($article->thumbnail);
                }
                $article->thumbnail = $request->file('thumbnail')->store('articles/thumbnails', 'public');
            }

            // Update article
            $article->update([
                'title' => $validated['title'],
                'deskripsi' => $validated['deskripsi'],
                'editor_id' => $validated['editor_id'] ?? $article->editor_id,
                'status' => $validated['status'],
                'published_at' => $validated['status'] === 'published' && !$article->published_at 
                    ? now() 
                    : $article->published_at,
            ]);

            // Delete old contents and save new ones
            $article->contents()->delete();
            $this->saveArticleContents($article, $request);

            return redirect()->route('admin.articles.index')
                ->with('success', 'Artikel berhasil diperbarui!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui artikel. Periksa kembali data Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui artikel. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified article
     */
    public function destroy(Article $article)
    {
        try {
            // Delete thumbnail
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $article->delete();

            return redirect()->route('admin.articles.index')
                ->with('success', 'Artikel berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus artikel. Silakan coba lagi.');
        }
    }

    /**
     * Update only the status of an article (draft|published).
     */
    public function updateStatus(Request $request, Article $article)
    {
        $validated = $request->validate([
            'status' => 'required|in:draft,published',
        ]);

        $newStatus = $validated['status'];

        // Adjust published_at accordingly
        $article->status = $newStatus;
        if ($newStatus === 'published') {
            // set published_at if not already set
            if (!$article->published_at) {
                $article->published_at = now();
            }
        } else {
            // draft: clear published_at to indicate not live
            $article->published_at = null;
        }

        $article->save();

        return back()->with('success', 'Status artikel diperbarui.');
    }

    /**
     * Helper: Save article contents (subheadings and paragraphs)
     */
    private function saveArticleContents(Article $article, Request $request)
    {
        $order = 1;

        // Get subheadings and paragraphs
        $subheadings = $request->input('subheadings', []);
        $paragraphs = $request->input('paragraphs', []);

        // Interleave subheadings and paragraphs
        $maxCount = max(count($subheadings), count($paragraphs));

        for ($i = 0; $i < $maxCount; $i++) {
            // Add subheading if exists
            if (isset($subheadings[$i]) && !empty($subheadings[$i])) {
                ArticleContent::create([
                    'article_id' => $article->id,
                    'content_type' => 'subheading',
                    'content' => $subheadings[$i],
                    'display_order' => $order++,
                ]);
            }

            // Add paragraph if exists
            if (isset($paragraphs[$i]) && !empty($paragraphs[$i])) {
                ArticleContent::create([
                    'article_id' => $article->id,
                    'content_type' => 'paragraph',
                    'content' => $paragraphs[$i],
                    'display_order' => $order++,
                ]);
            }
        }
    }
}