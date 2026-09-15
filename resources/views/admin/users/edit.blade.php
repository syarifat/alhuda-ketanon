<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="w-8 h-8 rounded-full bg-green-100 hover:bg-green-200 flex items-center justify-center text-green-700 transition-all" title="Kembali">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="font-black text-green-900 text-xl">Edit User</h2>
        </div>
    </x-slot>
    @if($errors->any())
        <div class="max-w-lg mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm font-medium">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-red-500 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
                <strong>Gagal memperbarui:</strong>
            </div>
            <ul class="list-disc list-inside ml-5 text-xs opacity-80">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-lg">
        <div class="admin-card">
            <!-- User avatar preview -->
            <div class="flex items-center gap-4 mb-6 pb-5 border-b border-green-100">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-xl shadow-md">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-black text-green-900">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">ID: {{ $user->id }} &nbsp;·&nbsp; Bergabung {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="form-label" for="name">Nama Lengkap</label>
                    <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                           class="form-input" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                </div>

                <div>
                    <label class="form-label" for="username">Username</label>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                           class="form-input font-mono" required>
                    <x-input-error :messages="$errors->get('username')" class="mt-1.5" />
                </div>



                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-4">
                    <p class="text-xs font-bold text-yellow-700 mb-3 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-yellow-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="7.5" cy="15.5" r="5.5"/>
                            <path d="m11.5 11.5 8.5-8.5M16 7l2 2m2-2-2-2"/>
                        </svg>
                        <span>Ubah Password</span>
                        <span class="font-normal text-yellow-600">(kosongkan jika tidak ingin mengubah)</span>
                    </p>
                    <div class="space-y-3">
                        <div>
                            <label class="form-label" for="password">Password Baru</label>
                            <input id="password" name="password" type="password"
                                   class="form-input" placeholder="Min. 8 karakter">
                            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                        </div>
                        <div>
                            <label class="form-label" for="password_confirmation">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="form-input" placeholder="Ulangi password baru">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="admin-btn-primary px-6 py-2.5 inline-flex items-center gap-2">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                            <polyline points="17 21 17 13 7 13 7 21"></polyline>
                            <polyline points="7 3 7 8 15 8"></polyline>
                        </svg>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="px-6 py-2.5 rounded-full text-sm font-bold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-all">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:20px; padding:28px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
        .form-label { display:block; font-size:0.7rem; font-weight:800; color:#15803d; text-transform:uppercase; letter-spacing:0.07em; margin-bottom:6px; }
        .form-input { display:block; width:100%; border:1.5px solid #bbf7d0; border-radius:12px; padding:10px 14px; font-size:0.875rem; color:#14532d; background:#f0fdf4; transition:border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.15); outline:none; }
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.8rem; font-weight:800; border-radius:9999px; box-shadow:0 2px 10px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; border:none; cursor:pointer; }
        .admin-btn-primary:hover { box-shadow:0 4px 16px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>
