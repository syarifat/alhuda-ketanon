<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Website Sekolah')) - {{ \App\Models\ProfilSekolah::first()->nama_sekolah ?? 'Sekolah Kami' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-inter antialiased text-gray-800 bg-gray-50 flex flex-col min-h-screen">

        {{-- Top Bar Info --}}
        <div class="bg-sekolah-green-dark text-white py-2 text-xs font-medium hidden sm:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    @php $kontak = \App\Models\PengaturanKontak::first(); @endphp
                    @if($kontak && $kontak->email_sekolah)
                        <a href="mailto:{{ $kontak->email_sekolah }}" class="flex items-center gap-2 hover:text-green-200 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ $kontak->email_sekolah }}
                        </a>
                    @endif
                    @if($kontak && $kontak->no_telepon)
                        <a href="tel:{{ $kontak->no_telepon }}" class="flex items-center gap-2 hover:text-green-200 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ $kontak->no_telepon }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center gap-4">
                    @if($kontak && $kontak->link_facebook)
                        <a href="{{ $kontak->link_facebook }}" target="_blank" class="hover:text-green-200 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                    @endif
                    @if($kontak && $kontak->link_instagram)
                        <a href="{{ $kontak->link_instagram }}" target="_blank" class="hover:text-green-200 transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                    @endif
                    @if($kontak && $kontak->link_youtube)
                        <a href="{{ $kontak->link_youtube }}" target="_blank" class="hover:text-green-200 transition-colors">
                            <span class="sr-only">YouTube</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" /></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- Main Navigation --}}
        <header class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50 transition-all duration-300" x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
                <div class="w-full py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        @php $profil = \App\Models\ProfilSekolah::first(); @endphp
                        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                            @if($profil && $profil->logo)
                                <img src="{{ Storage::disk('r2')->url($profil->logo) }}" alt="Logo {{ $profil->nama_sekolah }}" class="h-10 w-auto group-hover:scale-105 transition-transform">
                            @else
                                <div class="h-10 w-10 bg-sekolah-green rounded-xl flex items-center justify-center text-white font-bold group-hover:bg-sekolah-green-dark transition-colors">
                                    {{ substr($profil->nama_sekolah ?? 'S', 0, 1) }}
                                </div>
                            @endif
                            <span class="font-extrabold text-xl text-gray-800 tracking-tight hidden sm:block group-hover:text-sekolah-green transition-colors">{{ $profil->nama_sekolah ?? 'Sekolah Kita' }}</span>
                        </a>
                    </div>
                    
                    {{-- Desktop Menu --}}
                    <div class="hidden lg:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-sekolah-green font-bold' : 'text-gray-600 font-medium hover:text-sekolah-green' }} transition-colors">Beranda</a>
                        <a href="{{ route('public.profil') }}" class="{{ request()->routeIs('public.profil') ? 'text-sekolah-green font-bold' : 'text-gray-600 font-medium hover:text-sekolah-green' }} transition-colors">Profil Sekolah</a>
                        <a href="{{ route('public.galeri') }}" class="{{ request()->routeIs('public.galeri') ? 'text-sekolah-green font-bold' : 'text-gray-600 font-medium hover:text-sekolah-green' }} transition-colors">Galeri</a>
                        <a href="{{ route('public.berita') }}" class="{{ request()->routeIs('public.berita') || request()->routeIs('public.baca-berita') ? 'text-sekolah-green font-bold' : 'text-gray-600 font-medium hover:text-sekolah-green' }} transition-colors">Berita & Artikel</a>
                        <a href="{{ route('public.kontak') }}" class="btn-primary {{ request()->routeIs('public.kontak') ? 'ring-2 ring-offset-2 ring-sekolah-green' : '' }}">
                            Hubungi Kami
                        </a>
                    </div>

                    {{-- Mobile menu button --}}
                    <div class="lg:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" type="button" class="text-gray-600 hover:text-sekolah-green p-2 transition-colors">
                            <span class="sr-only">Open menu</span>
                            <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>

            {{-- Mobile Menu --}}
            <div x-show="mobileMenuOpen" x-collapse>
                <div class="px-4 pt-2 pb-6 space-y-2 lg:hidden bg-white shadow-lg border-t border-gray-100">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('home') ? 'bg-green-50 text-sekolah-green' : 'text-gray-700 hover:bg-gray-50' }}">Beranda</a>
                    <a href="{{ route('public.profil') }}" class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('public.profil') ? 'bg-green-50 text-sekolah-green' : 'text-gray-700 hover:bg-gray-50' }}">Profil Sekolah</a>
                    <a href="{{ route('public.galeri') }}" class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('public.galeri') ? 'bg-green-50 text-sekolah-green' : 'text-gray-700 hover:bg-gray-50' }}">Galeri Kegiatan</a>
                    <a href="{{ route('public.berita') }}" class="block px-3 py-2 rounded-lg font-medium {{ request()->routeIs('public.berita') || request()->routeIs('public.baca-berita') ? 'bg-green-50 text-sekolah-green' : 'text-gray-700 hover:bg-gray-50' }}">Berita & Artikel</a>
                    <a href="{{ route('public.kontak') }}" class="block px-3 py-2 rounded-lg font-medium text-center bg-sekolah-green text-white hover:bg-sekolah-green-dark mt-4">Hubungi Kami</a>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-grow">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-gray-900 text-white mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-12 lg:gap-8">
                    
                    <div class="lg:col-span-1">
                        <div class="flex items-center gap-3 mb-6">
                            @if($profil && $profil->logo)
                                <img src="{{ Storage::disk('r2')->url($profil->logo) }}" alt="Logo" class="h-12 w-auto bg-white p-1 rounded-lg">
                            @endif
                            <span class="font-extrabold text-xl">{{ $profil->nama_sekolah ?? 'Sekolah Kita' }}</span>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-6">
                            Membangun generasi cerdas, berkarakter, dan berwawasan luas untuk menyongsong masa depan yang gemilang.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-lg font-bold mb-6 flex items-center">
                            <span class="w-1.5 h-5 bg-sekolah-green rounded-full mr-3"></span>
                            Tautan Cepat
                        </h4>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white hover:ml-2 transition-all text-sm block">Beranda</a></li>
                            <li><a href="{{ route('public.profil') }}" class="text-gray-400 hover:text-white hover:ml-2 transition-all text-sm block">Profil Sekolah</a></li>
                            <li><a href="{{ route('public.galeri') }}" class="text-gray-400 hover:text-white hover:ml-2 transition-all text-sm block">Galeri Kegiatan</a></li>
                            <li><a href="{{ route('public.berita') }}" class="text-gray-400 hover:text-white hover:ml-2 transition-all text-sm block">Berita & Artikel</a></li>
                        </ul>
                    </div>

                    <div class="md:col-span-2 lg:col-span-2">
                        <h4 class="text-lg font-bold mb-6 flex items-center">
                            <span class="w-1.5 h-5 bg-sekolah-green rounded-full mr-3"></span>
                            Informasi Kontak
                        </h4>
                        <ul class="space-y-4">
                            @if($kontak && $kontak->alamat_lengkap)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-sekolah-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-gray-400 text-sm leading-relaxed">{{ $kontak->alamat_lengkap }}</span>
                            </li>
                            @endif
                            @if($kontak && $kontak->email_sekolah)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-sekolah-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="text-gray-400 text-sm">{{ $kontak->email_sekolah }}</span>
                            </li>
                            @endif
                            @if($kontak && $kontak->no_telepon)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-sekolah-green shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-gray-400 text-sm">{{ $kontak->no_telepon }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>

                </div>
                
                <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-500 text-sm text-center md:text-left">
                        &copy; {{ date('Y') }} {{ $profil->nama_sekolah ?? 'Sekolah Kita' }}. Hak Cipta Dilindungi Undang-Undang.
                    </p>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm text-sekolah-green hover:text-white transition-colors">Dasbor Admin</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-white transition-colors">Login Admin</a>
                        @endauth
                    </div>
                </div>
            </div>
        </footer>

        @stack('scripts')
        
        <style>
            .btn-primary {
                @apply inline-flex items-center justify-center px-6 py-2.5 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5 active:scale-95 text-sm;
            }
            .section-title {
                @apply text-3xl md:text-4xl font-extrabold text-gray-800 tracking-tight;
            }
            .section-subtitle {
                @apply text-sekolah-green font-bold tracking-widest uppercase text-sm mb-3 block;
            }
        </style>
    </body>
</html>
