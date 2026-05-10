<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:3072',
            'description' => 'nullable',
        ]);

        $path = $request->file('image')->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'image_path' => $path,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->image_path = $request->file('image')->store('galleries', 'public');
        }

        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->save();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image_path) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri telah dihapus.');
    }
}