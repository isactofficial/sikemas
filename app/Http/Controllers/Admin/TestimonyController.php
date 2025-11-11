<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonyController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimony::query();
        $sort = $request->get('sort_by');
        if ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $testimonies = $query->paginate(8)->withQueryString();
        return view('admin.testimonies.index', compact('testimonies'));
    }

    public function create()
    {
        return view('admin.testimonies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job' => 'nullable|string|max:255',
            'testimony' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('testimonies/images', 'public')
            : null;

        Testimony::create([
            'name' => $validated['name'],
            'job' => $validated['job'] ?? null,
            'testimony' => $validated['testimony'] ?? null,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil di buat');
    }

    public function show(Testimony $testimonial)
    {
        return view('admin.testimonies.show', ['testimony' => $testimonial]);
    }

    public function edit(Testimony $testimonial)
    {
        return view('admin.testimonies.edit', ['testimony' => $testimonial]);
    }

    public function update(Request $request, Testimony $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'job' => 'nullable|string|max:255',
            'testimony' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $testimonial->image = $request->file('image')->store('testimonies/images', 'public');
        }

        $testimonial->name = $validated['name'];
        $testimonial->job = $validated['job'] ?? null;
        $testimonial->testimony = $validated['testimony'] ?? null;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil di perbarui');
    }

    public function destroy(Testimony $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimoni berhasil di hapus');
    }
}
