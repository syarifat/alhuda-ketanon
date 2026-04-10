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
            <svg class="w-8 h-8 text-sekolah-green" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
            <span class="text-2xl font-bold text-sekolah-green-dark">CMS Sekolah</span>
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        
        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

        <a href="{{ route('dashboard') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
            Dashboard
        </a>

        @if(auth()->user()->hasAkses('profil_sekolah'))
            <a href="{{ url('#') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->is('profil*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                Profil Sekolah
            </a>
        @endif

        @if(auth()->user()->hasAkses('galeri_kegiatan'))
            <a href="{{ url('#') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->is('galeri*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                Galeri Kegiatan
            </a>
        @endif

        @if(auth()->user()->hasAkses('berita_artikel'))
            <a href="{{ url('#') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->is('berita*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                Berita & Artikel
            </a>
        @endif

        @if(auth()->user()->hasAkses('pesan_masuk'))
            <a href="{{ url('#') }}" 
               class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->is('pesan*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                Pesan Masuk
            </a>
        @endif

        @if(auth()->user()->role === 'superadmin')
            <div class="pt-4 mt-4 border-t border-gray-100">
                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Administrator</p>
                <a href="{{ route('user.index') }}"
                   class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors {{ request()->is('kelola-akses*') ? 'bg-sekolah-green text-white shadow-md' : 'text-gray-700 hover:bg-green-50 hover:text-sekolah-green' }}">
                    Kelola Hak Akses
                </a>
            </div>
        @endif

    </nav>
    
    <div class="p-4 border-t border-gray-200">
        <p class="text-xs text-center text-gray-500">&copy; {{ date('Y') }} CMS Sekolah</p>
    </div>
</div>