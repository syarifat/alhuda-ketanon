@extends('frontend.layout')

@section('content')

<!-- HERO SECTION -->
<section id="beranda" class="relative min-h-screen flex items-center overflow-hidden" style="background:linear-gradient(135deg,#052e16 0%,#14532d 50%,#166534 100%)">
    <!-- Decorative shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-green-400/10 blur-3xl"></div>
        <div class="absolute top-1/2 -right-40 w-96 h-96 rounded-full bg-emerald-300/10 blur-3xl"></div>
        <div class="absolute bottom-0 left-1/4 w-80 h-80 rounded-full bg-lime-300/5 blur-3xl"></div>
        <!-- Grid pattern -->
        <div class="absolute inset-0 opacity-[0.04]"
             style="background-image: linear-gradient(rgba(255,255,255,.15) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.15) 1px, transparent 1px);
                    background-size: 60px 60px;">
        </div>
        <!-- Floating dots canvas -->
        <canvas id="dots-canvas" class="absolute inset-0 w-full h-full"></canvas>
        <!-- Bottom wave -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path d="M0 80L1440 80L1440 20C1200 70 900 0 720 20C540 40 240 70 0 20L0 80Z" fill="#f0fdf4"/>
            </svg>
        </div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 lg:py-36">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Text -->
            <div>
                <div class="inline-flex items-center gap-2 mb-8">
                    <span class="w-8 h-px bg-green-400"></span>
                    <span class="text-green-400 text-xs font-bold uppercase tracking-[0.2em]">Website Resmi</span>
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white leading-[1.1] mb-6 tracking-tight">
                    {{ $profile->name ?? 'Selamat Datang' }}
                </h1>
                <p class="text-green-200/75 text-base md:text-lg leading-relaxed mb-10 max-w-lg">
                    {{ $profile->slogan ?? 'Membangun Generasi Cerdas dan Berkarakter' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#profil" class="btn-primary px-7 py-3.5 rounded-xl font-bold text-sm">Profil Sekolah</a>
                    <a href="#berita" class="btn-outline px-7 py-3.5 rounded-xl font-bold text-sm">Berita Terbaru</a>
                </div>
                <!-- Stats row -->
                <div class="flex gap-8 mt-14 pt-8 border-t border-white/10">
                    <div>
                        <p class="text-2xl font-black text-white">{{ $profile->npsn ?? '—' }}</p>
                        <p class="text-xs text-green-400/70 uppercase tracking-widest mt-1">NPSN</p>
                    </div>
                    <div>
                        <p class="text-2xl font-black text-white">{{ $profile->accreditation ?? '—' }}</p>
                        <p class="text-xs text-green-400/70 uppercase tracking-widest mt-1">Akreditasi</p>
                    </div>
                </div>
            </div>
            <!-- Right: Logo + decorative ring -->
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative">
                    <div class="w-72 h-72 rounded-full" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08)"></div>
                    <div class="absolute inset-6 rounded-full" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1)"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        @php
                            $logoUrl = ($profile && $profile->logo && Str::contains($profile->logo, ['/'])) ? Storage::url($profile->logo) : asset($profile->logo ?? 'logo.png');
                        @endphp
                        <img src="{{ $logoUrl }}" alt="Logo" class="w-40 h-40 object-contain drop-shadow-2xl">
                    </div>
                    <!-- Orbiting dot -->
                    <div class="absolute top-6 right-8 w-4 h-4 rounded-full bg-green-400 shadow-lg shadow-green-400/50"></div>
                    <div class="absolute bottom-10 left-4 w-3 h-3 rounded-full bg-emerald-300/60"></div>
                </div>
            </div>
        </div>
        <!-- Scroll hint -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 hidden md:flex flex-col items-center gap-2 text-green-500/50 text-xs">
            <span class="tracking-widest uppercase text-[10px]">Scroll</span>
            <div class="w-px h-10 bg-gradient-to-b from-green-500/50 to-transparent animate-bounce"></div>
        </div>
    </div>
</section>



<!-- PROFIL & SAMBUTAN SECTION -->
<section id="profil" class="py-20 bg-white" style="border-top:4px solid #16a34a">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="mb-14 reveal">
            <p class="text-xs font-black text-green-500 uppercase tracking-[0.2em] mb-2">Tentang Kami</p>
            <div class="flex items-end gap-4">
                <h2 class="text-3xl md:text-4xl font-black text-green-950">Profil Sekolah</h2>
                <div class="flex-1 h-px bg-green-100 mb-2 hidden sm:block"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Foto Kepsek -->
            <div class="lg:col-span-4 flex flex-col items-center reveal-left">
                <div class="relative w-52 h-52 md:w-64 md:h-64 mx-auto mb-6">
                    <div class="w-full h-full rounded-full p-1" style="background: linear-gradient(135deg, #16a34a, #4ade80, #86efac)">
                        <div class="w-full h-full rounded-full overflow-hidden bg-green-50">
                            @if($profile && $profile->principal_photo)
                                @php $photoUrl = Str::contains($profile->principal_photo, ['/']) ? Storage::url($profile->principal_photo) : asset($profile->principal_photo); @endphp
                                <img src="{{ $photoUrl }}" class="w-full h-full object-cover" alt="Kepala Sekolah">
                            @else
                                <div class="w-full h-full bg-green-100 flex items-center justify-center text-green-400 text-sm">Foto</div>
                            @endif
                        </div>
                    </div>
                    <!-- Decorative dot -->
                    <div class="absolute bottom-3 right-3 w-5 h-5 rounded-full bg-green-400 border-2 border-white shadow-md"></div>
                </div>
                <div class="text-center">
                    <div class="inline-flex items-center gap-1.5 bg-green-50 border border-green-200 text-green-700 text-xs font-bold px-3 py-1 rounded-full">
                        ✦ Kepala Madrasah
                    </div>
                </div>
            </div>

            <!-- Sambutan & Visi Misi -->
            <div class="lg:col-span-8 reveal-right">
                <span class="section-tag">Sambutan</span>
                <div class="divider-green"></div>
                <p class="text-green-800/80 leading-relaxed whitespace-pre-line text-sm md:text-base mb-10 text-justify">
                    {{ $profile->principal_message ?? 'Belum ada sambutan.' }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Visi -->
                    <div class="tilt-card rounded-2xl p-6 border border-green-200 bg-gradient-to-br from-green-50 to-emerald-50 shadow-sm hover:shadow-md transition-shadow">
                        <h4 class="text-base font-black text-green-800 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center text-green-700">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <circle cx="12" cy="12" r="6"></circle>
                                    <circle cx="12" cy="12" r="2"></circle>
                                </svg>
                            </span>
                            Visi
                        </h4>
                        <div class="w-8 h-0.5 bg-green-400 rounded mb-3"></div>
                        <p class="text-green-700/80 text-sm leading-relaxed whitespace-pre-line">{{ $profile->vision ?? '-' }}</p>
                    </div>
                    <!-- Misi -->
                    <div class="tilt-card rounded-2xl p-6 border border-emerald-200 bg-gradient-to-br from-emerald-50 to-teal-50 shadow-sm hover:shadow-md transition-shadow">
                        <h4 class="text-base font-black text-emerald-800 mb-3 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-700">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"></path>
                                    <path d="M12 15l-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"></path>
                                </svg>
                            </span>
                            Misi
                        </h4>
                        <div class="w-8 h-0.5 bg-emerald-400 rounded mb-3"></div>
                        <p class="text-emerald-700/80 text-sm leading-relaxed whitespace-pre-line">{{ $profile->mission ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- BERITA SECTION -->
<section id="berita" class="py-20" style="background:#f8faf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex justify-between items-end mb-10 reveal border-b-2 border-green-700 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-green-600 rounded"></div>
                <h2 class="text-2xl md:text-3xl font-black text-green-950">Berita &amp; Pengumuman</h2>
            </div>
            <a href="{{ route('news.index') }}" class="hidden sm:inline-flex items-center gap-1 text-xs font-bold text-green-600 hover:text-green-800 transition-colors">
                Semua Berita →
            </a>
        </div>

        @if($headline)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Headline (Kiri, Besar) -->
                <a href="{{ route('article.show', $headline->slug) }}" target="_blank" class="lg:col-span-2 group block reveal-left">
                    <div class="relative rounded-3xl overflow-hidden aspect-video shadow-xl border border-green-100">
                        @if($headline->thumbnail)
                            <img src="{{ Storage::url($headline->thumbnail) }}" alt="{{ $headline->title }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full bg-green-100 flex items-center justify-center text-green-500 text-sm">No Image</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-green-950/85 via-green-900/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <span class="inline-flex items-center gap-1 bg-green-400/25 border border-green-300/40 text-green-200 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-ping"></span>
                                Sorotan
                            </span>
                            <h3 class="text-xl md:text-2xl lg:text-3xl font-black text-white leading-tight group-hover:text-green-300 transition-colors line-clamp-2">
                                {{ $headline->title }}
                            </h3>
                            <p class="text-green-200/70 text-xs mt-3 flex items-center gap-3">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    {{ $headline->created_at->format('d M Y') }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    {{ $headline->views }} kali dibaca
                                </span>
                            </p>
                        </div>
                        <div class="absolute top-4 right-4 w-9 h-9 rounded-full bg-white/20 backdrop-blur border border-white/30 flex items-center justify-center text-white text-sm opacity-0 group-hover:opacity-100 transition-all duration-300">
                            ↗
                        </div>
                    </div>
                </a>

                <!-- List Berita Lainnya (Kanan) -->
                <div class="flex flex-col gap-4 reveal-right">
                    @foreach($articles as $article)
                        <a href="{{ route('article.show', $article->slug) }}" target="_blank"
                           class="flex items-center gap-4 group p-3 rounded-2xl border border-green-100 bg-white hover:border-green-300 hover:shadow-md transition-all duration-200">
                            <div class="w-20 h-20 flex-shrink-0 rounded-xl overflow-hidden bg-green-50 shadow-sm">
                                @if($article->thumbnail)
                                    <img src="{{ Storage::url($article->thumbnail) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" alt="{{ $article->title }}">
                                @else
                                    <div class="w-full h-full bg-green-100 flex items-center justify-center text-green-400 text-xs">No Img</div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-sm font-bold text-green-900 leading-snug group-hover:text-green-600 transition-colors line-clamp-2">
                                    {{ $article->title }}
                                </h4>
                                <p class="text-xs text-green-500/70 mt-1.5">{{ $article->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="text-green-300 group-hover:text-green-600 transition-colors text-lg flex-shrink-0">›</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-xs font-bold text-green-600 hover:text-green-800 uppercase tracking-widest transition-colors">
                    Lihat Semua Berita →
                </a>
            </div>
        @else
            <div class="text-center py-20 rounded-2xl border-2 border-dashed border-green-200 text-green-400 bg-white">
                Belum ada berita yang dipublikasikan.
            </div>
        @endif
    </div>
</section>



<!-- GALERI SECTION -->
<section id="galeri" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 reveal border-b-2 border-green-700 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-green-600 rounded"></div>
                <h2 class="text-2xl md:text-3xl font-black text-green-950">Galeri Kegiatan</h2>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-5 reveal">
            @forelse($galleries as $gallery)
                <button
                    onclick="openGalleryModal(
                        '{{ Storage::url($gallery->image_path) }}',
                        '{{ addslashes($gallery->title) }}',
                        '{{ addslashes($gallery->description ?? '') }}'
                    )"
                    class="relative group rounded-2xl overflow-hidden aspect-square bg-green-50 shadow-sm cursor-pointer focus:outline-none focus:ring-2 focus:ring-green-400 border border-green-100 hover:border-green-300 hover:shadow-xl transition-all duration-300"
                >
                    <img
                        src="{{ Storage::url($gallery->image_path) }}"
                        alt="{{ $gallery->title }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700"
                    >
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-green-950/80 via-green-900/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex flex-col items-center justify-end pb-5 px-3">
                        <div class="w-8 h-8 rounded-full bg-white/25 backdrop-blur border border-white/40 flex items-center justify-center text-white mb-2">
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <p class="text-white font-bold text-xs md:text-sm text-center line-clamp-2">{{ $gallery->title }}</p>
                    </div>
                </button>
            @empty
                <div class="col-span-full text-center py-20 text-green-400">Galeri masih kosong.</div>
            @endforelse
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="gallery-modal" class="fixed inset-0 z-[100] hidden" aria-modal="true" role="dialog">
        <div class="absolute inset-0 bg-green-950/80 backdrop-blur-md" onclick="closeGalleryModal()"></div>
        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 py-10">
            <!-- Close -->
            <button onclick="closeGalleryModal()"
                class="absolute top-5 right-5 w-10 h-10 rounded-full bg-white/15 hover:bg-white/30 border border-white/20 flex items-center justify-center text-white text-lg transition-all"
                aria-label="Tutup">
                ✕
            </button>
            <!-- Image -->
            <div class="w-full max-w-3xl">
                <img
                    id="modal-img"
                    src="" alt=""
                    class="w-full max-h-[65vh] rounded-2xl shadow-2xl border-4 border-white/10 object-contain mx-auto"
                >
                <!-- Caption box -->
                <div id="modal-info" class="mt-5 bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl px-6 py-4 text-center">
                    <p id="modal-title" class="text-white font-black text-lg md:text-xl"></p>
                    <p id="modal-desc"  class="text-green-200/80 text-sm mt-1.5 leading-relaxed"></p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- KONTAK SECTION -->
<section id="kontak" class="py-20" style="background:#f8faf8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 reveal border-b-2 border-green-700 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-green-600 rounded"></div>
                <h2 class="text-2xl md:text-3xl font-black text-green-950">Hubungi Kami</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 rounded-3xl overflow-hidden shadow-2xl border border-green-100 reveal">
            <!-- Info Kontak -->
            <div class="relative gradient-hero p-10 lg:p-12 flex flex-col justify-between overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-green-400/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative">
                    <h2 class="text-2xl font-black text-white mb-3">Hubungi Kami</h2>
                    <div class="w-10 h-1 bg-green-400 rounded mb-6"></div>
                    <p class="text-green-200/70 mb-10 leading-relaxed text-sm">
                        Punya pertanyaan mengenai pendaftaran, program sekolah, atau informasi lainnya? Jangan ragu untuk mengirimkan pesan kepada kami.
                    </p>
                    <div class="space-y-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-400/15 border border-green-400/20 flex items-center justify-center text-green-300 flex-shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <p class="text-green-100 text-sm leading-relaxed pt-2">{{ $profile->address ?? '-' }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-400/15 border border-green-400/20 flex items-center justify-center text-green-300 flex-shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                            <p class="text-green-100 text-sm">{{ $profile->whatsapp ?? '-' }}</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-green-400/15 border border-green-400/20 flex items-center justify-center text-green-300 flex-shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <p class="text-green-100 text-sm">{{ $profile->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Kontak -->
            <div class="bg-white p-10 lg:p-12">
                <h3 class="text-xl font-black text-green-900 mb-7">Kirim Pesan</h3>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center gap-2">
                        <span class="text-green-500">✓</span> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('send.message') }}" method="POST" class="space-y-5">
                    @csrf
                    {{-- Honeypot Anti-Spambot --}}
                    <div style="display:none;" aria-hidden="true">
                        <input type="text" name="website_hp_check" tabindex="-1" autocomplete="off">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-green-700 uppercase tracking-wider mb-2" for="name">Nama Lengkap</label>
                        <input
                            type="text" id="name" name="name" required
                            class="w-full bg-green-50/50 border border-green-200 rounded-xl px-4 py-3 text-sm text-green-900 placeholder-green-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                            placeholder="Masukkan nama lengkap Anda"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-green-700 uppercase tracking-wider mb-2" for="contact">Email / No. WhatsApp</label>
                        <input
                            type="text" id="contact" name="contact" required
                            class="w-full bg-green-50/50 border border-green-200 rounded-xl px-4 py-3 text-sm text-green-900 placeholder-green-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                            placeholder="email@contoh.com atau 08xx"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-green-700 uppercase tracking-wider mb-2" for="content">Isi Pesan</label>
                        <textarea
                            id="content" name="content" rows="4" required
                            class="w-full bg-green-50/50 border border-green-200 rounded-xl px-4 py-3 text-sm text-green-900 placeholder-green-300 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all resize-none"
                            placeholder="Tuliskan pertanyaan atau pesan Anda..."
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="btn-primary w-full py-3.5 px-6 rounded-xl font-bold text-sm tracking-wide"
                    >
                        Kirim Pesan Sekarang ✦
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Modal Script -->
<script>
    function openGalleryModal(src, title, description) {
        const modal   = document.getElementById('gallery-modal');
        const img     = document.getElementById('modal-img');
        const cap     = document.getElementById('modal-title');
        const desc    = document.getElementById('modal-desc');
        const info    = document.getElementById('modal-info');

        img.src       = src;
        img.alt       = title;
        cap.textContent = title;

        if (description && description.trim() !== '') {
            desc.textContent = description;
            desc.classList.remove('hidden');
        } else {
            desc.textContent = '';
            desc.classList.add('hidden');
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeGalleryModal() {
        document.getElementById('gallery-modal').classList.add('hidden');
        document.body.style.overflow = '';
        document.getElementById('modal-img').src = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeGalleryModal();
    });
</script>

@endsection