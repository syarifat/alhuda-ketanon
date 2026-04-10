<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Dashboard</h2>
        <p class="text-sm text-gray-500 mt-1">Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>! Berikut ringkasan kondisi website Anda.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('error'))
                <div class="mx-4 sm:mx-0 p-4 bg-red-50 border border-red-200 rounded-2xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span class="text-red-700 font-semibold text-sm">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 px-4 sm:px-0">
                
                {{-- Total Berita --}}
                @if(auth()->user()->hasAkses('berita_artikel'))
                    <a href="{{ route('berita.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green group-hover:text-white transition-colors">
                                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            </div>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_berita'] }}</div>
                        <div class="text-sm font-medium text-gray-500">Total Berita</div>
                        @if($stats['draft_berita'] > 0)
                            <div class="mt-2 text-xs font-semibold text-yellow-600 bg-yellow-50 px-2 py-0.5 rounded-full inline-block">
                                {{ $stats['draft_berita'] }} Draft
                            </div>
                        @endif
                    </a>
                @else
                    <div class="bg-gray-50 rounded-2xl shadow-sm border border-dashed border-gray-200 p-6 opacity-60">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-300 mb-1">—</div>
                        <div class="text-sm font-medium text-gray-400">Berita & Artikel</div>
                        <div class="text-xs text-gray-400 mt-1">Tidak ada akses</div>
                    </div>
                @endif

                {{-- Total Galeri --}}
                @if(auth()->user()->hasAkses('galeri_kegiatan'))
                    <a href="{{ route('galeri.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green group-hover:text-white transition-colors">
                                <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ $stats['total_galeri'] }}</div>
                        <div class="text-sm font-medium text-gray-500">Item Galeri</div>
                    </a>
                @else
                    <div class="bg-gray-50 rounded-2xl shadow-sm border border-dashed border-gray-200 p-6 opacity-60">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-300 mb-1">—</div>
                        <div class="text-sm font-medium text-gray-400">Galeri Kegiatan</div>
                        <div class="text-xs text-gray-400 mt-1">Tidak ada akses</div>
                    </div>
                @endif

                {{-- Pesan Belum Dibaca --}}
                @if(auth()->user()->hasAkses('pesan_masuk'))
                    <a href="{{ route('pesan.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group {{ $stats['pesan_belum_dibaca'] > 0 ? 'ring-2 ring-sekolah-green' : '' }}">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 {{ $stats['pesan_belum_dibaca'] > 0 ? 'bg-sekolah-green' : 'bg-green-100' }} rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 {{ $stats['pesan_belum_dibaca'] > 0 ? 'text-white' : 'text-sekolah-green' }} group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            @if($stats['pesan_belum_dibaca'] > 0)
                                <span class="text-xs font-bold text-white bg-red-500 px-2 py-0.5 rounded-full animate-pulse">Baru!</span>
                            @endif
                        </div>
                        <div class="text-3xl font-extrabold {{ $stats['pesan_belum_dibaca'] > 0 ? 'text-sekolah-green' : 'text-gray-800' }} mb-1">
                            {{ $stats['pesan_belum_dibaca'] }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">Pesan Belum Dibaca</div>
                    </a>
                @else
                    <div class="bg-gray-50 rounded-2xl shadow-sm border border-dashed border-gray-200 p-6 opacity-60">
                        <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-300 mb-1">—</div>
                        <div class="text-sm font-medium text-gray-400">Pesan Masuk</div>
                        <div class="text-xs text-gray-400 mt-1">Tidak ada akses</div>
                    </div>
                @endif

                {{-- Akses User (Superadmin Only) --}}
                @if(auth()->user()->role === 'superadmin')
                    <a href="{{ route('user.index') }}" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-600 transition-colors">
                                <svg class="w-6 h-6 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">Superadmin</span>
                        </div>
                        <div class="text-3xl font-extrabold text-gray-800 mb-1">{{ \App\Models\User::count() }}</div>
                        <div class="text-sm font-medium text-gray-500">Total Pengguna</div>
                    </a>
                @else
                    {{-- Tampilkan info profil user ini, berguna untuk semua admin --}}
                    <div class="bg-gradient-to-br from-sekolah-green to-sekolah-green-dark rounded-2xl shadow-sm p-6 text-white">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                            <span class="text-2xl font-extrabold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <div class="font-extrabold text-lg mb-1 truncate">{{ auth()->user()->name }}</div>
                        <div class="text-sekolah-green-light text-sm font-medium capitalize">{{ auth()->user()->role }}</div>
                        <div class="mt-2 text-xs text-white/70">
                            {{ auth()->user()->moduls->count() }} modul dapat diakses
                        </div>
                    </div>
                @endif
            </div>

            {{-- Menu Akses Cepat --}}
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Akses Cepat</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    
                    @if(auth()->user()->hasAkses('profil_sekolah'))
                        <a href="{{ route('profil.index') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Profil Sekolah</span>
                        </a>
                        <a href="{{ route('kontak.index') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Info Kontak</span>
                        </a>
                    @endif

                    @if(auth()->user()->hasAkses('galeri_kegiatan'))
                        <a href="{{ route('galeri.create') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Tambah Galeri</span>
                        </a>
                    @endif

                    @if(auth()->user()->hasAkses('berita_artikel'))
                        <a href="{{ route('berita.create') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Tulis Berita</span>
                        </a>
                    @endif

                    @if(auth()->user()->hasAkses('pesan_masuk'))
                        <a href="{{ route('pesan.index') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors relative">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                @if($stats['pesan_belum_dibaca'] > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $stats['pesan_belum_dibaca'] }}</span>
                                @endif
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Pesan Masuk</span>
                        </a>
                    @endif

                    @if(auth()->user()->role === 'superadmin')
                        <a href="{{ route('user.create') }}" class="flex flex-col items-center gap-3 p-5 bg-white border border-gray-200 rounded-2xl hover:border-sekolah-green hover:shadow-md hover:-translate-y-1 transition-all text-center group">
                            <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-sekolah-green transition-colors">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700 group-hover:text-sekolah-green transition-colors">Tambah Admin</span>
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
