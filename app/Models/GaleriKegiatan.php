<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriKegiatan extends Model
{
    protected $table = 'galeri_kegiatan';

    protected $fillable = [
        'judul_kegiatan',
        'media_path',
        'deskripsi_singkat',
        'tanggal_kegiatan',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];

    /**
     * Cek apakah media adalah link YouTube
     */
    public function isYoutube(): bool
    {
        return str_contains($this->media_path, 'youtube.com') || str_contains($this->media_path, 'youtu.be');
    }

    /**
     * Dapatkan embed URL YouTube
     */
    public function getYoutubeEmbedUrl(): string
    {
        $url = $this->media_path;
        // Handle youtu.be short links
        if (str_contains($url, 'youtu.be/')) {
            $id = substr($url, strrpos($url, '/') + 1);
            return "https://www.youtube.com/embed/{$id}";
        }
        // Handle youtube.com/watch?v=
        preg_match('/[?&]v=([^&]+)/', $url, $matches);
        if (isset($matches[1])) {
            return "https://www.youtube.com/embed/{$matches[1]}";
        }
        return $url;
    }
}
