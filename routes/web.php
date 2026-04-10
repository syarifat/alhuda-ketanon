<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilSekolahController;
use App\Http\Controllers\KontakSekolahController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\GaleriKegiatanController;
use App\Http\Controllers\BeritaArtikelController;
use App\Http\Controllers\PesanMasukController;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('public.profil');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('public.galeri');
Route::get('/berita', [PublicController::class, 'berita'])->name('public.berita');
Route::get('/berita/{slug}', [PublicController::class, 'bacaBerita'])->name('public.baca-berita');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('public.kontak');
Route::post('/kontak/kirim', [PublicController::class, 'kirimPesan'])->name('public.kirim-pesan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================================================== //
Route::middleware(['auth'])->group(function () {
    // Dashboard tetap bisa diakses semua yang login
    Route::get('/dashboard', function () {
        // Ambil data statistik ringkas untuk dashboard
        $stats = [
            'pesan_belum_dibaca' => \App\Models\PesanMasuk::where('is_read', false)->count(),
            'total_berita'       => \App\Models\BeritaArtikel::count(),
            'total_galeri'       => \App\Models\GaleriKegiatan::count(),
            'draft_berita'       => \App\Models\BeritaArtikel::where('status', 'Draft')->count(),
        ];
        return view('dashboard', compact('stats'));
    })->name('dashboard');

    // Semua Modul Admin
    Route::prefix('admin')->group(function () {
        // Khusus Superadmin: Kelola User & Hak Akses
        Route::middleware(['akses:superadmin_only'])->group(function () {
            Route::resource('user', UserController::class);
        });

        // Profil Sekolah
        Route::middleware(['akses:profil_sekolah'])->group(function () {
            Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profil.index');
            Route::post('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil.update');

            Route::get('/kontak-sekolah', [KontakSekolahController::class, 'index'])->name('kontak.index');
            Route::post('/kontak-sekolah', [KontakSekolahController::class, 'update'])->name('kontak.update');
        });

        // Galeri Kegiatan
        Route::middleware(['akses:galeri_kegiatan'])->group(function () {
            Route::resource('galeri', GaleriKegiatanController::class)->except(['show']);
        });

        // Berita & Artikel
        Route::middleware(['akses:berita_artikel'])->group(function () {
            // Kategori Berita
            Route::get('/kategori-berita', [KategoriBeritaController::class, 'index'])->name('kategori.index');
            Route::post('/kategori-berita', [KategoriBeritaController::class, 'store'])->name('kategori.store');
            Route::put('/kategori-berita/{kategori}', [KategoriBeritaController::class, 'update'])->name('kategori.update');
            Route::delete('/kategori-berita/{kategori}', [KategoriBeritaController::class, 'destroy'])->name('kategori.destroy');

            // Berita & Artikel
            Route::resource('berita', BeritaArtikelController::class)->except(['show']);
        });

        // Pesan Masuk
        Route::middleware(['akses:pesan_masuk'])->group(function () {
            Route::get('/pesan-masuk', [PesanMasukController::class, 'index'])->name('pesan.index');
            Route::post('/pesan-masuk/tandai-dibaca', [PesanMasukController::class, 'tandaiSemuaDibaca'])->name('pesan.tandai-dibaca');
            Route::get('/pesan-masuk/{pesan}', [PesanMasukController::class, 'show'])->name('pesan.show');
            Route::delete('/pesan-masuk/{pesan}', [PesanMasukController::class, 'destroy'])->name('pesan.destroy');
        });
    });

});

require __DIR__.'/auth.php';