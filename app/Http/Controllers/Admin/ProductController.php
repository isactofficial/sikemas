<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $sort = $request->get('sort_by');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $products = $query->paginate(8);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:products,name',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
                'category' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
                'description' => 'nullable|string',
                'notes' => 'nullable|string',
            ], [
                'name.required' => 'Nama produk wajib diisi.',
                'name.unique' => 'Produk dengan nama ini sudah ada. Silakan gunakan nama lain.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
                'image.max' => 'Ukuran gambar maksimal 4MB.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh negatif.',
            ]);

            // Generate slug dari name
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $counter = 1;
            
            // Pastikan slug unique
            while (Product::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            $imagePath = $request->hasFile('image')
                ? $request->file('image')->store('products/images', 'public')
                : null;

            Product::create([
                'name' => $validated['name'],
                'slug' => $slug,
                'image' => $imagePath,
                'category' => $validated['category'] ?? null,
                'price' => $validated['price'] ?? null,
                'description' => $validated['description'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk berhasil ditambahkan!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan produk. Periksa kembali data Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan produk. Silakan coba lagi.');
        }
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('products', 'name')->ignore($product->id)
                ],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
                'category' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
                'description' => 'nullable|string',
                'notes' => 'nullable|string',
            ], [
                'name.required' => 'Nama produk wajib diisi.',
                'name.unique' => 'Produk dengan nama ini sudah ada. Silakan gunakan nama lain.',
                'image.image' => 'File harus berupa gambar.',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
                'image.max' => 'Ukuran gambar maksimal 4MB.',
                'price.numeric' => 'Harga harus berupa angka.',
                'price.min' => 'Harga tidak boleh negatif.',
            ]);

            // Update slug jika name berubah
            if ($request->name !== $product->name) {
                $slug = Str::slug($validated['name']);
                $originalSlug = $slug;
                $counter = 1;
                
                // Pastikan slug unique (kecuali untuk produk ini sendiri)
                while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
                $product->slug = $slug;
            }

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $product->image = $request->file('image')->store('products/images', 'public');
            }

            $product->name = $validated['name'];
            $product->category = $validated['category'] ?? null;
            $product->price = $validated['price'] ?? null;
            $product->description = $validated['description'] ?? null;
            $product->notes = $validated['notes'] ?? null;
            $product->save();

            return redirect()->route('admin.products.index')
                ->with('success', 'Produk berhasil diperbarui!');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui produk. Periksa kembali data Anda.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui produk. Silakan coba lagi.');
        }
    }

    public function destroy(Product $product)
    {
        try {
            // Hapus gambar jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Produk berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus produk. Silakan coba lagi.');
        }
    }
}