<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanKontak extends Model
{
    protected $table = 'pengaturan_kontak';
    public $timestamps = false; // Karena pakai updated_at manual di migration

    protected $fillable = [
        'alamat_lengkap', 'email_sekolah', 'no_telepon', 
        'embed_maps', 'link_instagram', 'link_facebook', 'link_youtube'
    ];
}