@extends('frontend.layout')

@section('content')

<style>
    /* ── Article page reset ── */
    .article-page { background: #f8f9fa; min-height: 100vh; }

    /* ── Category tag ── */
    .art-category {
        display: inline-block;
        background: #16a34a;
        color: #fff;
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 2px;
        margin-bottom: 14px;
    }

    /* ── Title ── */
    .art-title {
        font-size: clamp(1.5rem, 4vw, 2.4rem);
        font-weight: 900;
        line-height: 1.25;
        color: #0f172a;
        margin-bottom: 16px;
        letter-spacing: -0.02em;
    }

    /* ── Lead / intro paragraph ── */
    .art-lead {
        font-size: 1.05rem;
        font-weight: 500;
        color: #374151;
        line-height: 1.7;
        border-left: 4px solid #16a34a;
        padding-left: 16px;
        margin-bottom: 24px;
    }

    /* ── Meta bar ── */
    .art-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 14px 0;
        border-top: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 28px;
        font-size: 0.78rem;
        color: #6b7280;
    }
    .art-meta-divider { color: #d1d5db; }
    .art-meta-views {
        display: flex; align-items: center; gap: 5px;
        background: #f0fdf4; color: #16a34a;
        font-weight: 700; padding: 3px 10px; border-radius: 9999px;
        border: 1px solid #bbf7d0;
        font-size: 0.72rem;
    }

    /* ── Thumbnail (full bleed) ── */
    .art-thumb-wrap {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 10px;
        background: #e5e7eb;
        aspect-ratio: 16/9;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
    .art-thumb-wrap img {
        width: 100%; height: 100%;
        object-fit: cover;
        display: block;
    }
    .art-thumb-caption {
        font-size: 0.72rem;
        color: #9ca3af;
        font-style: italic;
        margin-bottom: 28px;
        padding-left: 4px;
    }

    /* ── Share bar ── */
    .share-bar {
        display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
        padding: 14px 16px;
        background: #f0fdf4;
        border-radius: 10px;
        border: 1px solid #dcfce7;
        margin-bottom: 28px;
        font-size: 0.75rem; font-weight: 700; color: #374151;
    }
    .share-btn {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 6px;
        font-size: 0.72rem; font-weight: 700;
        border: none; cursor: pointer; transition: opacity 0.15s;
        text-decoration: none; color: #fff;
    }
    .share-btn:hover { opacity: 0.85; }
    .share-wa   { background: #25d366; }
    .share-copy { background: #64748b; }

    /* ── Article prose ── */
    .art-body {
        font-size: 1.02rem;
        line-height: 1.85;
        color: #1e293b;
    }
    .art-body p { margin-bottom: 1.4em; }
    .art-body h2 { font-size: 1.35rem; font-weight: 800; color: #0f172a; margin: 2em 0 0.6em; border-bottom: 2px solid #16a34a; padding-bottom: 6px; display: inline-block; }
    .art-body h3 { font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 1.6em 0 0.5em; }
    .art-body strong { color: #0f172a; font-weight: 700; }
    .art-body a { color: #16a34a; font-weight: 600; text-decoration: underline; text-underline-offset: 3px; }
    .art-body ul, .art-body ol { padding-left: 1.4em; margin-bottom: 1.4em; }
    .art-body li { margin-bottom: 0.4em; }
    .art-body ul li::marker { color: #16a34a; }
    .art-body blockquote {
        border-left: 4px solid #16a34a;
        margin: 1.6em 0; padding: 14px 20px;
        background: #f0fdf4; border-radius: 0 10px 10px 0;
        font-style: italic; color: #374151;
    }
    .art-body img { width: 100%; border-radius: 10px; margin: 1.4em 0; box-shadow: 0 2px 16px rgba(0,0,0,0.08); }
    .art-body table { width: 100%; border-collapse: collapse; margin: 1.4em 0; font-size: 0.9rem; }
    .art-body th { background: #f0fdf4; color: #14532d; font-weight: 700; padding: 10px 12px; border: 1px solid #dcfce7; text-align: left; }
    .art-body td { padding: 9px 12px; border: 1px solid #e5e7eb; }
    .art-body tr:nth-child(even) td { background: #f9fafb; }

    /* ── Sidebar widgets ── */
    .widget-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 20px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.04);
    }
    .widget-title {
        font-size: 0.72rem;
        font-weight: 900;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #fff;
        background: linear-gradient(90deg, #16a34a, #22c55e);
        padding: 9px 16px;
    }
    .related-item {
        display: flex; gap: 10px; align-items: center;
        padding: 12px 14px;
        border-bottom: 1px solid #f1f5f9;
        transition: background 0.15s;
        text-decoration: none;
    }
    .related-item:hover { background: #f0fdf4; }
    .related-item:last-child { border-bottom: none; }
    .related-img {
        width: 68px; height: 52px; border-radius: 6px;
        object-fit: cover; flex-shrink: 0;
        background: #e5e7eb;
    }
    .related-item-title {
        font-size: 0.78rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .related-item-date { font-size: 0.65rem; color: #9ca3af; margin-top: 4px; }

    /* ── Back / footer bar ── */
    .art-footer-bar {
        border-top: 2px solid #e5e7eb;
        margin-top: 40px;
        padding-top: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    /* ── Reading progress bar ── */
    #read-progress {
        position: fixed; top: 60px; left: 0; right: 0; z-index: 999;
        height: 3px;
        background: linear-gradient(90deg, #16a34a, #4ade80);
        width: 0%;
        transition: width 0.1s linear;
        border-radius: 0 2px 2px 0;
    }

    /* ── Breadcrumb ── */
    .art-breadcrumb {
        font-size: 0.72rem;
        color: #9ca3af;
        display: flex; flex-wrap: wrap; align-items: center; gap: 5px;
        margin-bottom: 16px;
    }
    .art-breadcrumb a { color: #6b7280; hover: underline; transition: color 0.15s; }
    .art-breadcrumb a:hover { color: #16a34a; }

    @media (max-width: 640px) {
        .art-title { font-size: 1.4rem; }
        .art-body { font-size: 0.95rem; }
    }
</style>

<!-- Reading progress bar -->
<div id="read-progress"></div>

<div class="article-page">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            {{-- ── MAIN ARTICLE COLUMN ── --}}
            <main class="flex-1 min-w-0">

                {{-- Breadcrumb --}}
                <nav class="art-breadcrumb">
                    <a href="{{ route('home') }}">Beranda</a>
                    <span>›</span>
                    <a href="{{ route('news.index') }}">Berita</a>
                    <span>›</span>
                    <span class="text-gray-500 line-clamp-1">{{ Str::limit($article->title, 50) }}</span>
                </nav>

                {{-- Category --}}
                <span class="art-category">📰 Berita</span>

                {{-- Title --}}
                <h1 class="art-title">{{ $article->title }}</h1>

                {{-- Meta bar --}}
                <div class="art-meta">
                    <svg class="w-3.5 h-3.5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></svg>
                    <span>{{ $article->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                    <span class="art-meta-divider">|</span>
                    <span>Tim Redaksi</span>
                    <span class="art-meta-divider">|</span>
                    <span class="art-meta-views">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ number_format($article->views) }} dibaca
                    </span>
                </div>

                {{-- Share bar --}}
                <div class="share-bar">
                    <span>Bagikan:</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' ' . request()->url()) }}"
                       target="_blank" class="share-btn share-wa">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                    <button onclick="copyLink()" class="share-btn share-copy" id="copy-btn">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Salin Link
                    </button>
                </div>

                {{-- Thumbnail --}}
                @if($article->thumbnail)
                <figure>
                    <div class="art-thumb-wrap">
                        <img src="{{ Storage::url($article->thumbnail) }}"
                             alt="{{ $article->title }}" loading="lazy">
                    </div>
                    <figcaption class="art-thumb-caption">
                        Foto: {{ $article->title }}
                    </figcaption>
                </figure>
                @endif

                {{-- Body --}}
                <div class="art-body" id="article-body">
                    {!! $article->content !!}
                </div>

                {{-- Tags / footer --}}
                <div class="art-footer-bar">
                    <a href="{{ route('news.index') }}"
                       class="inline-flex items-center gap-2 text-sm font-bold text-green-700 hover:text-green-900 border border-green-200 hover:border-green-400 px-4 py-2 rounded-full bg-green-50 hover:bg-green-100 transition-all">
                        ← Kembali ke Berita
                    </a>
                    <span class="text-xs text-gray-400">Terbit: {{ $article->created_at->translatedFormat('d F Y') }}</span>
                </div>

                {{-- Source / editor note --}}
                <div class="mt-6 p-4 bg-gray-50 border border-gray-100 rounded-xl text-xs text-gray-400 leading-relaxed">
                    <strong class="text-gray-500">Editor:</strong> Tim Redaksi {{ config('app.name') }} &nbsp;·&nbsp;
                    <strong class="text-gray-500">Sumber:</strong> Redaksi Internal
                </div>
            </main>

            {{-- ── SIDEBAR ── --}}
            <aside class="w-full lg:w-72 flex-shrink-0">

                {{-- Related articles widget --}}
                <div class="widget-card sticky top-[72px]">
                    <div class="widget-title">📰 Berita Lainnya</div>
                    @php
                        $related = \App\Models\Article::where('id', '!=', $article->id)
                            ->where('is_published', true)
                            ->latest()
                            ->take(6)
                            ->get();
                    @endphp
                    @forelse($related as $rel)
                        <a href="{{ route('article.show', $rel->slug) }}" target="_blank" class="related-item">
                            @if($rel->thumbnail)
                                <img src="{{ Storage::url($rel->thumbnail) }}"
                                     class="related-img" alt="{{ $rel->title }}" loading="lazy">
                            @else
                                <div class="related-img bg-green-50 flex items-center justify-center text-green-300 text-lg">📰</div>
                            @endif
                            <div class="min-w-0">
                                <div class="related-item-title">{{ $rel->title }}</div>
                                <div class="related-item-date">{{ $rel->created_at->format('d M Y') }}</div>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-xs text-gray-400 text-center">Belum ada berita lain.</div>
                    @endforelse
                </div>

                {{-- School info widget --}}
                <div class="widget-card">
                    <div class="widget-title">🏫 Tentang Kami</div>
                    <div class="p-4 text-center">
                        @php
                            $logoUrl = ($profile && $profile->logo && Str::contains($profile->logo, ['/'])) ? Storage::url($profile->logo) : asset($profile->logo ?? 'logo.png');
                        @endphp
                        <img src="{{ $logoUrl }}" alt="Logo" class="w-16 h-16 mx-auto mb-3 object-contain">
                        <p class="font-black text-sm text-gray-800">{{ config('app.name') }}</p>
                        <a href="{{ route('home') }}"
                           class="mt-3 inline-block text-xs font-bold text-green-700 border border-green-300 px-4 py-1.5 rounded-full hover:bg-green-50 transition-all">
                            Kunjungi Website →
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>

<script>
    // Reading progress bar
    const prog = document.getElementById('read-progress');
    const body = document.getElementById('article-body');
    window.addEventListener('scroll', () => {
        if (!body) return;
        const rect  = body.getBoundingClientRect();
        const total = body.offsetHeight - window.innerHeight;
        const done  = Math.max(0, -rect.top);
        prog.style.width = Math.min(100, (done / total) * 100) + '%';
    }, { passive: true });

    // Copy link
    function copyLink() {
        navigator.clipboard.writeText(window.location.href).then(() => {
            const btn = document.getElementById('copy-btn');
            btn.textContent = '✓ Tersalin!';
            setTimeout(() => { btn.innerHTML = '<svg class="w-3.5 h-3.5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2"/></svg> Salin Link'; }, 2000);
        });
    }
</script>

@endsection
