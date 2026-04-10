<?php

namespace App\Http\Controllers;

use App\Models\BeritaArtikel;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaArtikelController extends Controller
{
    public function index(Request $request)
    {
        $query = BeritaArtikel::with('kategori')->latest();

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        $berita    = $query->paginate(10)->withQueryString();
        $kategori  = KategoriBerita::orderBy('nama_kategori')->get();

        return view('admin.berita.index', compact('berita', 'kategori'));
    }

    public function create()
    {
        $kategori = KategoriBerita::orderBy('nama_kategori')->get();
        return view('admin.berita.form', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'konten'            => 'required|string',
            'kategori_id'       => 'nullable|exists:kategori_berita,id',
            'penulis'           => 'nullable|string|max:100',
            'tanggal_publikasi' => 'nullable|date',
            'status'            => 'required|in:Draft,Publish',
            'gambar_cover'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except('gambar_cover');
        $data['slug'] = Str::slug($request->judul) . '-' . Str::random(5);

        // Set tanggal_publikasi otomatis jika dipublish
        if ($request->status === 'Publish' && !$request->filled('tanggal_publikasi')) {
            $data['tanggal_publikasi'] = now();
        }

        if ($request->hasFile('gambar_cover')) {
            $path = $request->file('gambar_cover')->store('uploads/berita', 'r2');
            $data['gambar_cover'] = $path;
        }

        BeritaArtikel::create($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil disimpan!');
    }

    public function edit(BeritaArtikel $berita)
    {
        $kategori = KategoriBerita::orderBy('nama_kategori')->get();
        return view('admin.berita.form', compact('berita', 'kategori'));
    }

    public function update(Request $request, BeritaArtikel $berita)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'konten'            => 'required|string',
            'kategori_id'       => 'nullable|exists:kategori_berita,id',
            'penulis'           => 'nullable|string|max:100',
            'tanggal_publikasi' => 'nullable|date',
            'status'            => 'required|in:Draft,Publish',
            'gambar_cover'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $data = $request->except('gambar_cover');
        // Perbarui slug hanya jika judul berubah
        if ($berita->judul !== $request->judul) {
            $data['slug'] = Str::slug($request->judul) . '-' . Str::random(5);
        }

        // Set tanggal_publikasi otomatis jika baru dipublish
        if ($request->status === 'Publish' && !$berita->tanggal_publikasi && !$request->filled('tanggal_publikasi')) {
            $data['tanggal_publikasi'] = now();
        }

        if ($request->hasFile('gambar_cover')) {
            if ($berita->gambar_cover) {
                Storage::disk('r2')->delete($berita->gambar_cover);
            }
            $path = $request->file('gambar_cover')->store('uploads/berita', 'r2');
            $data['gambar_cover'] = $path;
        }

        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(BeritaArtikel $berita)
    {
        if ($berita->gambar_cover) {
            Storage::disk('r2')->delete($berita->gambar_cover);
        }

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus!');
    }
}
