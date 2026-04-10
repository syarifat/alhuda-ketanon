<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaArtikel extends Model
{
    protected $table = 'berita_artikel';

    protected $fillable = [
        'judul',
        'slug',
        'gambar_cover',
        'konten',
        'kategori_id',
        'penulis',
        'tanggal_publikasi',
        'status',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    /**
     * Relasi ke KategoriBerita
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    /**
     * Scope untuk filter berita yang sudah dipublish
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'Publish');
    }

    /**
     * Hitung perkiraan waktu baca
     */
    public function getReadingTimeAttribute(): int
    {
        $wordCount = str_word_count(strip_tags($this->konten));
        return max(1, (int) ceil($wordCount / 200));
    }
}
