<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanMasuk extends Model
{
    protected $table = 'pesan_masuk';
    public $timestamps = false; // Tabel hanya punya tanggal_masuk, bukan created_at/updated_at standar

    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'subjek',
        'isi_pesan',
        'tanggal_masuk',
        'is_read',
    ];

    protected $casts = [
        'tanggal_masuk' => 'datetime',
        'is_read'       => 'boolean',
    ];
}
