<?php

namespace App\Http\Controllers;

use App\Models\BeritaArtikel;
use App\Models\GaleriKegiatan;
use App\Models\PengaturanKontak;
use App\Models\PesanMasuk;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $profil = ProfilSekolah::first();
        $kontak = PengaturanKontak::first();
        $berita_terbaru = BeritaArtikel::published()->latest()->take(3)->get();
        $galeri_terbaru = GaleriKegiatan::latest()->take(6)->get();

        return view('public.home', compact('profil', 'kontak', 'berita_terbaru', 'galeri_terbaru'));
    }

    public function profil()
    {
        $profil = ProfilSekolah::first();
        $kontak = PengaturanKontak::first();
        return view('public.profil', compact('profil', 'kontak'));
    }

    public function galeri()
    {
        $galeri = GaleriKegiatan::latest()->paginate(12);
        $kontak = PengaturanKontak::first();
        return view('public.galeri', compact('galeri', 'kontak'));
    }

    public function berita(Request $request)
    {
        $query = BeritaArtikel::published()->latest();
        
        if ($request->has('kategori')) {
            $query->whereHas('kategori', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $berita = $query->paginate(9);
        $kontak = PengaturanKontak::first();
        return view('public.berita', compact('berita', 'kontak'));
    }

    public function bacaBerita($slug)
    {
        $berita = BeritaArtikel::published()->where('slug', $slug)->firstOrFail();
        $berita_lainnya = BeritaArtikel::published()->where('id', '!=', $berita->id)->latest()->take(3)->get();
        $kontak = PengaturanKontak::first();
        return view('public.baca-berita', compact('berita', 'berita_lainnya', 'kontak'));
    }

    public function kontak()
    {
        $kontak = PengaturanKontak::first();
        return view('public.kontak', compact('kontak'));
    }

    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama_pengirim'  => 'required|string|max:150',
            'email_pengirim' => 'required|email|max:150',
            'subjek'         => 'nullable|string|max:255',
            'isi_pesan'      => 'required|string',
        ]);

        PesanMasuk::create([
            'nama_pengirim'  => $request->nama_pengirim,
            'email_pengirim' => $request->email_pengirim,
            'subjek'         => $request->subjek,
            'isi_pesan'      => $request->isi_pesan,
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan merespon secepatnya via email.');
    }
}
