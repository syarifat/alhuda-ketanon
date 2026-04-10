@extends('layouts.public')

@section('content')

{{-- Hero Section --}}
<div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
        <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-16 sm:pt-24 lg:pt-32 px-4 sm:px-6 lg:px-8">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
                <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <div class="sm:text-center lg:text-left">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                    <span class="block xl:inline">Selamat Datang di</span>
                    <span class="block text-sekolah-green mt-2">{{ $profil->nama_sekolah ?? 'Sekolah Kita' }}</span>
                </h1>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 leading-relaxed">
                    {{ Str::limit(strip_tags($profil->sambutan_kepala_sekolah ?? 'Membangun generasi cerdas, berkarakter, dan berwawasan luas untuk menyongsong masa depan yang gemilang.'), 150) }}
                </p>
                <div class="mt-8 sm:mt-10 sm:flex sm:justify-center lg:justify-start gap-4">
                    <a href="{{ route('public.profil') }}" class="btn-primary w-full sm:w-auto px-8 py-4 text-base md:text-lg">
                        Mengenal Kami
                    </a>
                    <a href="{{ route('public.berita') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-4 border-2 border-green-100 text-sekolah-green font-bold rounded-xl hover:bg-green-50 transition-colors mt-3 sm:mt-0 text-base md:text-lg">
                        Berita Terbaru
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2 bg-gray-100 flex items-center justify-center">
        @if($profil && $profil->foto_kepala_sekolah)
            <img class="h-56 w-full object-cover object-top sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ Storage::disk('r2')->url($profil->foto_kepala_sekolah) }}" alt="Kepala Sekolah">
            <div class="absolute bottom-6 left-6 lg:bottom-12 lg:left-12 bg-white/90 backdrop-blur-md p-4 rounded-2xl shadow-xl max-w-xs border border-white/50">
                <p class="font-extrabold text-gray-900">{{ $profil->nama_kepala_sekolah }}</p>
                <p class="text-xs text-sekolah-green font-bold uppercase tracking-wider mt-1">Kepala Sekolah</p>
            </div>
        @else
            <div class="h-56 w-full sm:h-72 md:h-96 lg:h-full flex items-center justify-center bg-gradient-to-br from-green-50 to-green-100">
                <svg class="w-32 h-32 text-green-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        @endif
    </div>
</div>

{{-- Sambutan Ringkas --}}
@if($profil && $profil->sambutan_kepala_sekolah)
<div class="bg-gray-50 py-20 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-[3rem] p-8 md:p-16 shadow-xl border border-gray-100 relative">
            <svg class="absolute top-8 left-8 w-16 h-16 text-green-100 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
            <div class="relative z-10 max-w-3xl mx-auto text-center">
                <span class="section-subtitle">Sambutan Kepala Sekolah</span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-6 font-serif">Selamat Datang di Portal Informasi Resmi</h2>
                <div class="prose prose-lg text-gray-600 mx-auto italic leading-relaxed">
                    {{ Str::limit(strip_tags($profil->sambutan_kepala_sekolah), 300) }}
                </div>
                <div class="mt-8">
                    <a href="{{ route('public.profil') }}" class="inline-flex items-center text-sekolah-green font-bold hover:text-sekolah-green-dark">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{-- Berita Terbaru --}}
@if($berita_terbaru->count() > 0)
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="section-subtitle">Pusat Informasi</span>
                <h2 class="section-title">Berita & Artikel Terbaru</h2>
            </div>
            <a href="{{ route('public.berita') }}" class="btn-primary shrink-0 hidden md:inline-flex">Lihat Semua Berita</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($berita_terbaru as $item)
                <a href="{{ route('public.baca-berita', $item->slug) }}" class="group flex flex-col bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-56 overflow-hidden bg-gray-100">
                        @if($item->gambar_cover)
                            <img src="{{ Storage::disk('r2')->url($item->gambar_cover) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            </div>
                        @endif
                        @if($item->kategori)
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-lg text-xs font-bold text-sekolah-green-dark shadow-sm">
                                {{ $item->kategori->nama_kategori }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <div class="flex items-center gap-3 text-xs text-gray-400 font-medium mb-3">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                {{ $item->tanggal_publikasi->format('d M Y') }}
                            </span>
                            <span>•</span>
                            <span>Oleh {{ $item->penulis }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-sekolah-green transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-3 mb-6 flex-grow">
                            {{ Str::limit(strip_tags($item->konten), 120) }}
                        </p>
                        <div class="mt-auto flex items-center text-sekolah-green font-bold text-sm">
                            Baca Artikel
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        
        <div class="mt-10 text-center md:hidden">
            <a href="{{ route('public.berita') }}" class="btn-primary w-full">Lihat Semua Berita</a>
        </div>
    </div>
</div>
@endif

{{-- Galeri Highlight --}}
@if($galeri_terbaru->count() > 0)
<div class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="section-subtitle justify-center flex">Dokumentasi</span>
            <h2 class="section-title">Galeri Kegiatan Sekolah</h2>
            <p class="mt-4 text-gray-500 max-w-2xl mx-auto">Momen-momen berharga dalam memajukan pendidikan dan kreativitas siswa tercinta.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($galeri_terbaru->take(8) as $item)
                <div class="relative group rounded-2xl overflow-hidden aspect-square bg-gray-200">
                    @if($item->isYoutube())
                        <div class="absolute inset-0 bg-gray-900 flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                            <div class="w-12 h-12 bg-red-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                            </div>
                        </div>
                    @else
                        <img src="{{ Storage::disk('r2')->url($item->media_path) }}" alt="{{ $item->judul_kegiatan }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <div>
                            <p class="text-white font-bold text-sm line-clamp-2 leading-tight">{{ $item->judul_kegiatan }}</p>
                            <p class="text-gray-300 text-xs mt-1">{{ $item->tanggal_kegiatan->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('public.galeri') }}" class="btn-primary">Jelajahi Galeri Selengkapnya</a>
        </div>
    </div>
</div>
@endif

@endsection
