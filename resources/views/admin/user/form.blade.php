<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            {{ isset($user) ? 'Edit Akun Admin' : 'Tambah Admin Baru' }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">Kelola data login dan hak akses modul untuk staf sekolah.</p>
    </x-slot>

    <div class="py-12" x-data="{ role: '{{ isset($user) ? $user->role : 'admin' }}' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <form action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" method="POST" class="space-y-8">
                        @csrf
                        @if(isset($user)) @method('PUT') @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-bold text-sekolah-green-dark border-b pb-2 mb-4">Informasi Akun</h3>
                            </div>

                            <div>
                                <x-input-label value="Nama Lengkap" class="font-semibold text-gray-700" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    </div>
                                    <x-text-input name="name" class="block w-full pl-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg transition-all" :value="old('name', $user->name ?? '')" required placeholder="Nama Lengkap Staf" />
                                </div>
                            </div>

                            <div>
                                <x-input-label value="Username" class="font-semibold text-gray-700" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-bold">@</span>
                                    </div>
                                    <x-text-input name="username" class="block w-full pl-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg transition-all" :value="old('username', $user->username ?? '')" required placeholder="username_login" />
                                </div>
                            </div>

                            <div>
                                <x-input-label value="Password {{ isset($user) ? '(Kosongkan jika tidak ganti)' : '' }}" class="font-semibold text-gray-700" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </div>
                                    <x-text-input type="password" name="password" class="block w-full pl-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg transition-all" placeholder="********" />
                                </div>
                            </div>

                            <div>
                                <x-input-label value="Konfirmasi Password" class="font-semibold text-gray-700" />
                                <div class="mt-2 relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <x-text-input type="password" name="password_confirmation" class="block w-full pl-10 py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg transition-all" placeholder="Ulangi password" />
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h3 class="text-lg font-bold text-sekolah-green-dark border-b pb-2 mb-4">Level Akses</h3>
                            
                            <div class="max-w-md">
                                <x-input-label value="Pilih Role Akun" class="font-semibold text-gray-700" />
                                <select name="role" x-model="role" class="block mt-2 w-full py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg shadow-sm transition-all font-medium">
                                    <option value="admin">Admin (Akses Terbatas)</option>
                                    <option value="superadmin">Superadmin (Akses Penuh)</option>
                                </select>
                            </div>

                            <div x-show="role == 'admin'" 
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-100 ring-1 ring-green-200">
                                
                                <div class="flex items-center gap-2 mb-4">
                                    <svg class="w-5 h-5 text-sekolah-green" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    <p class="font-bold text-sekolah-green-dark">Otoritas Modul</p>
                                </div>
                                
                                <p class="text-xs text-green-700 mb-6 italic">*Admin hanya dapat melihat menu yang dicentang di bawah ini.</p>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($moduls as $m)
                                        <label class="flex items-center p-3 bg-white rounded-xl border border-green-100 cursor-pointer hover:border-sekolah-green hover:shadow-sm transition-all group">
                                            <input type="checkbox" name="moduls[]" value="{{ $m->id }}" 
                                                {{ isset($userModuls) && in_array($m->id, $userModuls) ? 'checked' : '' }}
                                                class="w-5 h-5 rounded border-gray-300 text-sekolah-green focus:ring-sekolah-green">
                                            <span class="ms-3 text-sm font-semibold text-gray-700 group-hover:text-sekolah-green-dark transition-colors">{{ $m->nama_modul }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div x-show="role == 'superadmin'" class="p-4 bg-purple-50 rounded-xl border border-purple-100 flex items-start gap-3">
                                <svg class="w-6 h-6 text-purple-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <p class="text-sm text-purple-800">
                                    <strong>Perhatian:</strong> Akun Superadmin memiliki akses penuh ke seluruh sistem, termasuk pengaturan hak akses admin lainnya.
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 flex flex-col sm:flex-row justify-end items-center gap-4 pt-8 border-t border-gray-100">
                            <a href="{{ route('user.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                                Batal & Kembali
                            </a>
                            <button type="submit" class="w-full sm:w-auto flex justify-center items-center px-8 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                {{ isset($user) ? 'Simpan Perubahan' : 'Daftarkan Admin' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>