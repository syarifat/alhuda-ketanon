<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ModulAplikasi;
use Illuminate\Support\Facades\Hash;

class UserDanModulSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Superadmin
        User::create([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'password' => Hash::make('password'), // Password default
            'role' => 'superadmin'
        ]);

        // 2. Daftarkan Semua Modul/Menu CMS
        ModulAplikasi::insert([
            ['nama_modul' => 'Profil Sekolah', 'kode_modul' => 'profil_sekolah', 'created_at' => now(), 'updated_at' => now()],
            ['nama_modul' => 'Galeri Kegiatan', 'kode_modul' => 'galeri_kegiatan', 'created_at' => now(), 'updated_at' => now()],
            ['nama_modul' => 'Berita & Artikel', 'kode_modul' => 'berita_artikel', 'created_at' => now(), 'updated_at' => now()],
            ['nama_modul' => 'Pesan Masuk', 'kode_modul' => 'pesan_masuk', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}