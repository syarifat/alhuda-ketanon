<?php

namespace App\Http\Controllers;

use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        // Tampilkan semua kategori, urutkan dari yang terbaru
        $kategori = KategoriBerita::latest()->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_berita,nama_kategori'
        ]);

        KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori)
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function update(Request $request, KategoriBerita $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_berita,nama_kategori,' . $kategori->id
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori)
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(KategoriBerita $kategori)
    {
        // Nanti di sini bisa ditambah logika: cegah hapus kalau kategori ini lagi dipakai di berita
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}