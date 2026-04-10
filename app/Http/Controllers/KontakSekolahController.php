<?php

namespace App\Http\Controllers;

use App\Models\PengaturanKontak;
use Illuminate\Http\Request;

class KontakSekolahController extends Controller
{
    public function index()
    {
        $kontak = PengaturanKontak::first() ?? new PengaturanKontak();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email_sekolah' => 'nullable|email',
            'no_telepon' => 'nullable|string|max:50',
        ]);

        $kontak = PengaturanKontak::first() ?: new PengaturanKontak();
        $kontak->fill($request->all())->save();

        return back()->with('success', 'Informasi kontak berhasil diperbarui!');
    }
}