<div x-show="sidebarOpen" 
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-20 bg-gray-900 bg-opacity-50 lg:hidden" 
     @click="sidebarOpen = false">
</div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" 
     class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-white border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0 shadow-lg lg:shadow-none flex flex-col">
    
    <div class="flex items-center justify-center h-20 border-b border-gray-100">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <svg class="w-8 h-8 text-sekolah-green" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
            <span class="text-2xl font-bold text-sekolah-green-dark">CMS Sekolah</span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1">
        
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Menu Utama</p>

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            Dashboard
        </a>

        {{-- Profil Sekolah & Kontak --}}
        @if(auth()->user()->hasAkses('profil_sekolah'))
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Profil & Kontak</p>
            </div>
            <a href="{{ route('profil.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('profil.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                Profil Sekolah
            </a>

            <a href="{{ route('kontak.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kontak.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                Info Kontak
            </a>
        @endif

        {{-- Galeri Kegiatan --}}
        @if(auth()->user()->hasAkses('galeri_kegiatan'))
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Galeri</p>
            </div>
            <a href="{{ route('galeri.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('galeri.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Galeri Kegiatan
            </a>
        @endif

        {{-- Berita & Artikel --}}
        @if(auth()->user()->hasAkses('berita_artikel'))
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Konten</p>
            </div>
            <a href="{{ route('berita.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('berita.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                Berita & Artikel
            </a>
            <a href="{{ route('kategori.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('kategori.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                Kategori Berita
            </a>
        @endif

        {{-- Pesan Masuk --}}
        @if(auth()->user()->hasAkses('pesan_masuk'))
            <div class="pt-2">
                <p class="px-4 text-[10px] font-bold text-gray-300 uppercase tracking-widest mb-1">Komunikasi</p>
            </div>
            @php
                $pesanBelumDibaca = \App\Models\PesanMasuk::where('is_read', false)->count();
            @endphp
            <a href="{{ route('pesan.index') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('pesan.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                Pesan Masuk
                @if($pesanBelumDibaca > 0)
                    <span class="ml-auto text-xs font-bold {{ request()->routeIs('pesan.*') ? 'bg-white text-sekolah-green' : 'bg-red-500 text-white' }} px-2 py-0.5 rounded-full">
                        {{ $pesanBelumDibaca }}
                    </span>
                @endif
            </a>
        @endif

        {{-- Administrator (Khusus Superadmin) --}}
        @if(auth()->user()->role === 'superadmin')
            <div class="pt-4 mt-4 border-t border-gray-100">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Administrator</p>
                <a href="{{ route('user.index') }}"
                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('user.*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    Kelola Hak Akses
                </a>
            </div>
        @endif

    </nav>
    
    <div class="p-4 border-t border-gray-200">
        <p class="text-xs text-center text-gray-500">&copy; {{ date('Y') }} CMS Sekolah</p>
    </div>
</div>