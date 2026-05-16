<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-green-900 text-xl">⚙️ Pengaturan Akun</h2>
    </x-slot>

    <div class="max-w-xl space-y-6">

        {{-- Update Profile --}}
        <div class="admin-card">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-xl shadow-md">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-black text-green-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400">@ {{ Auth::user()->username }}</p>
                </div>
            </div>

            <h3 class="text-sm font-black text-green-800 mb-4 flex items-center gap-2">
                <span class="w-1 h-4 bg-green-400 rounded inline-block"></span>
                Informasi Profil
            </h3>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf @method('patch')
                <div>
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                           class="form-input" required autofocus autocomplete="name">
                    <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
                </div>
                <div>
                    <label class="form-label" for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                           class="form-input" required autocomplete="username">
                    <x-input-error class="mt-1.5" :messages="$errors->get('username')" />
                </div>
                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="admin-btn-primary px-6 py-2.5">Simpan Perubahan</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)"
                           class="text-xs text-green-600 font-bold">✓ Tersimpan!</p>
                    @endif
                </div>
            </form>
        </div>

        {{-- Update Password --}}
        <div class="admin-card">
            <h3 class="text-sm font-black text-green-800 mb-4 flex items-center gap-2">
                <span class="w-1 h-4 bg-emerald-400 rounded inline-block"></span>
                Ubah Password
            </h3>
            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                @csrf @method('put')
                <div>
                    <label class="form-label" for="current_password">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password"
                           class="form-input" autocomplete="current-password">
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
                </div>
                <div>
                    <label class="form-label" for="password">Password Baru</label>
                    <input id="password" name="password" type="password"
                           class="form-input" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
                </div>
                <div>
                    <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="form-input" autocomplete="new-password">
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
                </div>
                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="admin-btn-primary px-6 py-2.5">Perbarui Password</button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{show:true}" x-show="show" x-transition x-init="setTimeout(()=>show=false,2000)"
                           class="text-xs text-green-600 font-bold">✓ Password diperbarui!</p>
                    @endif
                </div>
            </form>
        </div>

    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:20px; padding:24px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
        .form-label { display:block; font-size:0.7rem; font-weight:800; color:#15803d; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:6px; }
        .form-input { display:block; width:100%; border:1px solid #bbf7d0; border-radius:12px; padding:10px 14px; font-size:0.875rem; color:#14532d; background:#f0fdf4; transition:border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.15); outline:none; }
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.8rem; font-weight:800; border-radius:9999px; box-shadow:0 2px 10px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; border:none; cursor:pointer; }
        .admin-btn-primary:hover { box-shadow:0 4px 16px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>
