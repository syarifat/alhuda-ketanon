<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    protected $table = 'kategori_berita';
    
    protected $fillable = ['nama_kategori', 'slug'];

    public function berita()
    {
        return $this->hasMany(BeritaArtikel::class, 'kategori_id');
    }
}