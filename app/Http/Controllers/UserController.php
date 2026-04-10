<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModulAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('moduls')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $moduls = ModulAplikasi::all();
        return view('admin.user.form', compact('moduls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'lowercase', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:superadmin,admin'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Jika dia admin, sinkronkan modul yang dipilih
        if ($request->role === 'admin' && $request->has('moduls')) {
            $user->moduls()->sync($request->moduls);
        }

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $moduls = ModulAplikasi::all();
        $userModuls = $user->moduls->pluck('id')->toArray();
        return view('admin.user.form', compact('user', 'moduls', 'userModuls'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:100', 'unique:users,username,'.$user->id],
            'role' => ['required', 'in:superadmin,admin'],
        ]);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        // Update Hak Akses Modul
        if ($request->role === 'admin') {
            $user->moduls()->sync($request->moduls ?? []);
        } else {
            // Jika diubah jadi superadmin, hapus semua record di pivot agar bersih
            $user->moduls()->detach();
        }

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'superadmin' && User::where('role', 'superadmin')->count() <= 1) {
            return back()->with('error', 'Tidak dapat menghapus superadmin terakhir!');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}