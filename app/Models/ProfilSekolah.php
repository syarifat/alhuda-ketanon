<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';
    public $timestamps = false; // Karena kita pakai manual updated_at di migration

    protected $fillable = [
        'nama_sekolah', 'logo', 'visi', 'misi', 
        'sejarah_singkat', 'nama_kepala_sekolah', 
        'foto_kepala_sekolah', 'sambutan_kepala_sekolah'
    ];
}