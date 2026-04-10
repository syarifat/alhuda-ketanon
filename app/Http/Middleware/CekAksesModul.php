<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekAksesModul
{
    public function handle(Request $request, Closure $next, $kode_modul): Response
    {
        $user = Auth::user();

        // Fitur khusus: Jika kodenya 'superadmin_only', hanya superadmin yang boleh masuk
        if ($kode_modul === 'superadmin_only') {
            if ($user->role === 'superadmin') {
                return $next($request);
            }
            abort(403, 'Akses Ditolak: Halaman ini khusus Super Administrator.');
        }

        // Gunakan helper yang kita buat di Model tadi
        if ($user->hasAkses($kode_modul)) {
            return $next($request);
        }

        // Jika tidak punya akses, tendang kembali ke dashboard
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke modul tersebut.');
    }
}