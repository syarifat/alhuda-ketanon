<?php

namespace App\Http\Controllers;

use App\Models\ProfilSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilSekolahController extends Controller
{
    public function index()
    {
        // Ambil data pertama, jika tidak ada buat object kosong
        $profil = ProfilSekolah::first() ?? new ProfilSekolah();
        return view('admin.profil.index', compact('profil'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'foto_kepala_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profil = ProfilSekolah::first() ?: new ProfilSekolah();
        $data = $request->except(['logo', 'foto_kepala_sekolah']);

        // Handle Upload Logo ke R2
        if ($request->hasFile('logo')) {
            // Hapus file lama jika ada
            if ($profil->logo) { Storage::disk('r2')->delete($profil->logo); }
            
            $path = $request->file('logo')->store('uploads/profil', 'r2');
            $data['logo'] = $path;
        }

        // Handle Upload Foto Kepala Sekolah ke R2
        if ($request->hasFile('foto_kepala_sekolah')) {
            if ($profil->foto_kepala_sekolah) { Storage::disk('r2')->delete($profil->foto_kepala_sekolah); }
            
            $path = $request->file('foto_kepala_sekolah')->store('uploads/profil', 'r2');
            $data['foto_kepala_sekolah'] = $path;
        }

        $profil->fill($data)->save();

        return back()->with('success', 'Profil sekolah berhasil diperbarui!');
    }
}