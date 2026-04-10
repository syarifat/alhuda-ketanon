<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulAplikasi extends Model
{
    // Mengarahkan ke nama tabel yang benar sesuai migration
    protected $table = 'modul_aplikasi';

    protected $fillable = [
        'nama_modul',
        'kode_modul',
    ];

    // Relasi balik Many-to-Many ke tabel users
    public function users()
    {
        return $this->belongsToMany(User::class, 'akses_modul_user', 'modul_id', 'user_id');
    }
}