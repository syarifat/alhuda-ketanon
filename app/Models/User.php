<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username', // Pastikan ini username
        'password',
        'role',     // Pastikan role ada di sini
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // 1. Relasi Many-to-Many ke tabel modul_aplikasi
    public function moduls()
    {
        return $this->belongsToMany(ModulAplikasi::class, 'akses_modul_user', 'user_id', 'modul_id');
    }

    // 2. Fungsi Pengecekan Akses (Ini yang tadi error/tidak terbaca)
    public function hasAkses($kode_modul): bool
    {
        // Jika dia superadmin, langsung kasih akses
        if ($this->role === 'superadmin') {
            return true;
        }

        // Jika dia admin biasa, cek ke tabel pivot (akses_modul_user)
        return $this->moduls()->where('kode_modul', $kode_modul)->exists();
    }
}