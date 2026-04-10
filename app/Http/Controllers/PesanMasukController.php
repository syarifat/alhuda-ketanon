<?php

namespace App\Http\Controllers;

use App\Models\PesanMasuk;
use Illuminate\Http\Request;

class PesanMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = PesanMasuk::orderBy('tanggal_masuk', 'desc');

        // Filter berdasarkan status baca
        if ($request->filled('status')) {
            if ($request->status === 'belum_dibaca') {
                $query->where('is_read', false);
            } elseif ($request->status === 'sudah_dibaca') {
                $query->where('is_read', true);
            }
        }

        $pesan        = $query->paginate(15)->withQueryString();
        $jumlahBelumDibaca = PesanMasuk::where('is_read', false)->count();

        return view('admin.pesan.index', compact('pesan', 'jumlahBelumDibaca'));
    }

    public function show(PesanMasuk $pesan)
    {
        // Tandai sebagai sudah dibaca ketika dibuka
        if (!$pesan->is_read) {
            $pesan->update(['is_read' => true]);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(PesanMasuk $pesan)
    {
        $pesan->delete();
        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }

    /**
     * Tandai semua pesan sebagai sudah dibaca
     */
    public function tandaiSemuaDibaca()
    {
        PesanMasuk::where('is_read', false)->update(['is_read' => true]);
        return back()->with('success', 'Semua pesan telah ditandai sebagai sudah dibaca.');
    }
}
