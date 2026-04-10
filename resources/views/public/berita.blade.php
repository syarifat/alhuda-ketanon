@extends('layouts.public')

@section('title', 'Berita & Artikel')

@section('content')

{{-- Header Banner --}}
<div class="bg-gray-900 border-b border-gray-800 pt-10 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-sekolah-green via-gray-900 to-gray-900"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Berita & Artikel</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">Pusat informasi terbaru, pengumuman, dan artikel menarik seputar kegiatan serta prestasi.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 pb-24">
    
    {{-- Categories / Filters --}}
    @php
        $categories = \App\Models\KategoriBerita::has('berita')->get();
    @endphp
    @if($categories->count() > 0)
    <div class="bg-white p-4 rounded-2xl shadow-md border border-gray-100 flex flex-nowrap overflow-x-auto gap-3 mb-10 pb-4 md:pb-4 scrollbar-hide">
        <a href="{{ route('public.berita') }}" class="whitespace-nowrap px-5 py-2.5 rounded-xl font-bold text-sm transition-colors shrink-0 {{ !request('kategori') ? 'bg-sekolah-green text-white shadow-sm' : 'bg-gray-50 text-gray-600 hover:bg-green-50 hover:text-sekolah-green' }}">
            Semua Berita
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('public.berita', ['kategori' => $cat->slug]) }}" class="whitespace-nowrap px-5 py-2.5 rounded-xl font-bold text-sm transition-colors shrink-0 {{ request('kategori') == $cat->slug ? 'bg-sekolah-green text-white shadow-sm' : 'bg-gray-50 text-gray-600 hover:bg-green-50 hover:text-sekolah-green' }}">
                {{ $cat->nama_kategori }}
            </a>
        @endforeach
    </div>
    @endif

    @if($berita->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($berita as $item)
                <a href="{{ route('public.baca-berita', $item->slug) }}" class="group flex flex-col bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative h-64 overflow-hidden bg-gray-100">
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
                                {{ $item->tanggal_publikasi->translatedFormat('d M Y') }}
                            </span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                {{ $item->reading_time }}
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-sekolah-green transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-3 mb-6 flex-grow">
                            {{ Str::limit(strip_tags($item->konten), 120) }}
                        </p>
                        <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between">
                            <div class="text-xs text-gray-500 font-medium">
                                Oleh <span class="font-bold text-gray-700">{{ $item->penulis }}</span>
                            </div>
                            <div class="flex items-center text-sekolah-green font-bold text-sm">
                                Baca
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        @if($berita->hasPages())
            <div class="mt-12">
                {{ $berita->links() }}
            </div>
        @endif

    @else
        <div class="bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm mt-8">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada berita</h3>
            <p class="text-gray-500">
                @if(request('kategori'))
                    Tidak ada berita ditemukan untuk kategori ini.
                @else
                    Informasi dan artikel belum tersedia untuk saat ini.
                @endif
            </p>
            @if(request('kategori'))
                <a href="{{ route('public.berita') }}" class="btn-primary mt-6">Tampilkan Semua Berita</a>
            @endif
        </div>
    @endif
</div>

@endsection
