@extends('layouts.public')

@section('title', 'Galeri Kegiatan')

@section('content')

{{-- Header Banner --}}
<div class="bg-gray-900 border-b border-gray-800 pt-10 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-sekolah-green via-gray-900 to-gray-900"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Galeri Kegiatan</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">Momen-momen berharga dan dokumentasi aktivitas yang menginspirasi di lingkungan sekolah.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20 pb-24">
    
    @if($galeri->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($galeri as $item)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    
                    {{-- Media --}}
                    <div class="relative aspect-video sm:aspect-square bg-gray-200 overflow-hidden">
                        @if($item->isYoutube())
                            <img src="https://img.youtube.com/vi/{{ $item->getYoutubeId() }}/hqdefault.jpg" alt="{{ $item->judul_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center group-hover:bg-black/20 transition-colors duration-300">
                                <a href="{{ $item->media_path }}" target="_blank" class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center shadow-lg shadow-red-500/50 transform group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </a>
                            </div>
                        @else
                            <img src="{{ Storage::disk('r2')->url($item->media_path) }}" alt="{{ $item->judul_kegiatan }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            {{-- Modal trigger (kalau mau dibikin modal nanti, saat ini click view tab baru saja) --}}
                            <a href="{{ Storage::disk('r2')->url($item->media_path) }}" target="_blank" class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                <div class="w-12 h-12 bg-white/90 backdrop-blur rounded-full flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity transform scale-50 group-hover:scale-100 duration-300 shadow-lg">
                                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                </div>
                            </a>
                        @endif
                        
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur px-2.5 py-1 rounded-md text-[10px] font-bold text-gray-800 shadow-sm">
                            Tema {{ $item->isYoutube() ? 'Video' : 'Foto' }}
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-xs text-sekolah-green font-bold mb-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $item->tanggal_kegiatan->translatedFormat('d F Y') }}
                        </div>
                        <h3 class="font-bold text-gray-900 leading-tight mb-2 line-clamp-2" title="{{ $item->judul_kegiatan }}">{{ $item->judul_kegiatan }}</h3>
                        @if($item->deskripsi_singkat)
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $item->deskripsi_singkat }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        @if($galeri->hasPages())
            <div class="mt-12">
                {{ $galeri->links() }}
            </div>
        @endif

    @else
        <div class="bg-white rounded-3xl p-16 text-center border border-gray-100 shadow-sm mt-8">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada galeri</h3>
            <p class="text-gray-500">Dokumentasi kegiatan sekolah belum tersedia untuk saat ini.</p>
        </div>
    @endif
</div>

@endsection
