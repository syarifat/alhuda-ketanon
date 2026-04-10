@extends('layouts.public')

@section('title', $berita->judul)

@section('content')

{{-- Article Header --}}
<div class="bg-white border-b border-gray-100 pt-8 pb-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8">
        
        @if($berita->kategori)
            <a href="{{ route('public.berita', ['kategori' => $berita->kategori->slug]) }}" class="inline-block px-3 py-1 bg-green-50 text-sekolah-green-dark text-xs font-bold uppercase tracking-widest rounded-lg mb-6 hover:bg-sekolah-green hover:text-white transition-colors">
                {{ $berita->kategori->nama_kategori }}
            </a>
        @endif
        
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight leading-tight mb-8">
            {{ $berita->judul }}
        </h1>

        <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-500 font-medium">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <span>{{ $berita->penulis }}</span>
            </div>
            <span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                {{ $berita->tanggal_publikasi->translatedFormat('d F Y') }}
            </div>
            <span class="w-1.5 h-1.5 bg-gray-300 rounded-full"></span>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ $berita->reading_time }}
            </div>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20 pb-24">
    
    {{-- Cover Image --}}
    @if($berita->gambar_cover)
    <div class="rounded-3xl overflow-hidden shadow-2xl mb-12 border border-white max-h-[500px] flex items-center justify-center bg-gray-100">
        <img src="{{ Storage::disk('r2')->url($berita->gambar_cover) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover">
    </div>
    @else
    <div class="h-16"></div> {{-- Spacer --}}
    @endif

    {{-- Content --}}
    <article class="prose prose-lg sm:prose-xl prose-green mx-auto text-gray-700 leading-relaxed bg-white p-8 sm:p-12 rounded-3xl shadow-sm border border-gray-100">
        {{-- Inject Quill styles for content rendering --}}
        @push('styles')
        <style>
            .prose img { border-radius: 1rem; margin-left: auto; margin-right: auto; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
            .prose blockquote { border-left-color: var(--color-sekolah-green); background-color: #f0fdf4; padding: 1rem 1.5rem; border-radius: 0 1rem 1rem 0; font-style: italic; }
            .prose pre { background-color: #1f2937; color: #f3f4f6; border-radius: 1rem; padding: 1.5rem; }
            .prose code { color: var(--color-sekolah-green-dark); background-color: #f3f4f6; padding: 0.2rem 0.4rem; border-radius: 0.25rem; }
            .prose a { color: var(--color-sekolah-green); text-decoration: none; border-bottom: 2px solid transparent; transition: all 0.3s; }
            .prose a:hover { border-bottom-color: var(--color-sekolah-green); }
        </style>
        @endpush

        {!! nl2br($berita->konten) !!}
    </article>

    {{-- Share & Back --}}
    <div class="mt-12 pt-8 border-t border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('public.berita') }}" class="inline-flex items-center text-gray-500 hover:text-sekolah-green font-medium transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Berita
        </a>
        
        <div class="flex items-center gap-3">
            <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Bagikan:</span>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-blue-600 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-sky-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->judul . ' ' . request()->fullUrl()) }}" target="_blank" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-green-500 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.88-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.876 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
            </a>
        </div>
    </div>
</div>

{{-- Berita Lainnya --}}
@if($berita_lainnya->count() > 0)
<div class="bg-gray-50 py-16 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 border-l-4 border-sekolah-green pl-4">Baca Juga Artikel Lainnya</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($berita_lainnya as $item)
                <a href="{{ route('public.baca-berita', $item->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 flex flex-col transition-all">
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        @if($item->gambar_cover)
                            <img src="{{ Storage::disk('r2')->url($item->gambar_cover) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-5 flex-grow">
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-2">{{ $item->tanggal_publikasi->translatedFormat('d M Y') }}</div>
                        <h3 class="font-bold text-gray-800 leading-snug group-hover:text-sekolah-green transition-colors line-clamp-2">
                            {{ $item->judul }}
                        </h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
