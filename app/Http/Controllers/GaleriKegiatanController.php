<?php

namespace App\Http\Controllers;

use App\Models\GaleriKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriKegiatanController extends Controller
{
    public function index()
    {
        $galeri = GaleriKegiatan::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_kegiatan'   => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_singkat'=> 'nullable|string|max:500',
            'tipe_media'       => 'required|in:gambar,youtube',
            'gambar'           => 'required_if:tipe_media,gambar|nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'link_youtube'     => 'required_if:tipe_media,youtube|nullable|url',
        ], [
            'gambar.required_if'     => 'File gambar wajib diunggah.',
            'link_youtube.required_if' => 'Link YouTube wajib diisi.',
        ]);

        $data = $request->only(['judul_kegiatan', 'tanggal_kegiatan', 'deskripsi_singkat']);

        if ($request->tipe_media === 'gambar') {
            $path = $request->file('gambar')->store('uploads/galeri', 'r2');
            $data['media_path'] = $path;
        } else {
            $data['media_path'] = $request->link_youtube;
        }

        GaleriKegiatan::create($data);

        return redirect()->route('galeri.index')->with('success', 'Item galeri berhasil ditambahkan!');
    }

    public function edit(GaleriKegiatan $galeri)
    {
        return view('admin.galeri.form', compact('galeri'));
    }

    public function update(Request $request, GaleriKegiatan $galeri)
    {
        $request->validate([
            'judul_kegiatan'   => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'deskripsi_singkat'=> 'nullable|string|max:500',
            'tipe_media'       => 'required|in:gambar,youtube',
            'gambar'           => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'link_youtube'     => 'required_if:tipe_media,youtube|nullable|url',
        ]);

        $data = $request->only(['judul_kegiatan', 'tanggal_kegiatan', 'deskripsi_singkat']);

        if ($request->tipe_media === 'gambar') {
            if ($request->hasFile('gambar')) {
                // Hapus file lama jika ada dan bukan YouTube link
                if ($galeri->media_path && !$galeri->isYoutube()) {
                    Storage::disk('r2')->delete($galeri->media_path);
                }
                $path = $request->file('gambar')->store('uploads/galeri', 'r2');
                $data['media_path'] = $path;
            }
            // Jika tidak ada file baru, biarkan media_path lama (jika tipe sama)
        } else {
            // Hapus file lama dari storage jika sebelumnya adalah gambar
            if ($galeri->media_path && !$galeri->isYoutube()) {
                Storage::disk('r2')->delete($galeri->media_path);
            }
            $data['media_path'] = $request->link_youtube;
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')->with('success', 'Item galeri berhasil diperbarui!');
    }

    public function destroy(GaleriKegiatan $galeri)
    {
        // Hapus file dari storage jika bukan YouTube
        if ($galeri->media_path && !$galeri->isYoutube()) {
            Storage::disk('r2')->delete($galeri->media_path);
        }

        $galeri->delete();

        return back()->with('success', 'Item galeri berhasil dihapus!');
    }
}
