@extends('frontend.layout')

@section('content')

<style>
    .news-page { background: #f8f9fa; min-height: 100vh; }
    
    /* ── Header ── */
    .news-header {
        background: #fff;
        border-bottom: 1px solid #e5e7eb;
        padding: 40px 0;
        margin-bottom: 40px;
    }
    .news-title {
        font-size: 2rem;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.02em;
        margin-bottom: 16px;
    }
    
    /* ── Search Bar ── */
    .search-box {
        position: relative;
        max-w: 600px;
    }
    .search-input {
        width: 100%;
        padding: 14px 20px 14px 48px;
        border-radius: 9999px;
        border: 1px solid #d1d5db;
        font-size: 0.95rem;
        transition: all 0.2s;
        background: #f9fafb;
    }
    .search-input:focus {
        background: #fff;
        border-color: #16a34a;
        outline: none;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.1);
    }
    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        width: 20px;
        height: 20px;
    }

    /* ── Card ── */
    .news-card {
        display: flex;
        gap: 20px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        transition: all 0.2s;
        text-decoration: none;
        align-items: center;
        margin-bottom: 20px;
    }
    .news-card:hover {
        border-color: #bbf7d0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        transform: translateY(-2px);
    }
    .news-img {
        width: 160px;
        height: 110px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        background: #f3f4f6;
    }
    .news-content {
        flex: 1;
        min-width: 0;
    }
    .news-tag {
        display: inline-block;
        font-size: 0.65rem;
        font-weight: 800;
        color: #16a34a;
        background: #f0fdf4;
        padding: 3px 8px;
        border-radius: 4px;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .news-card-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .news-card:hover .news-card-title {
        color: #16a34a;
    }
    .news-meta {
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* ── Sidebar ── */
    .widget-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.02);
    }
    .widget-title {
        font-size: 0.85rem;
        font-weight: 900;
        color: #fff;
        background: linear-gradient(90deg, #16a34a, #22c55e);
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .pop-item {
        display: flex;
        gap: 12px;
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        text-decoration: none;
        align-items: flex-start;
        transition: background 0.2s;
    }
    .pop-item:hover {
        background: #f8fafc;
    }
    .pop-item:last-child {
        border-bottom: none;
    }
    .pop-number {
        font-size: 1.5rem;
        font-weight: 900;
        color: #dcfce7;
        line-height: 1;
        min-width: 24px;
    }
    .pop-item:hover .pop-number {
        color: #16a34a;
    }
    .pop-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Pagination Styling */
    .pagination-wrap {
        margin-top: 40px;
    }

    @media (max-width: 640px) {
        .news-card {
            flex-direction: column;
            gap: 12px;
        }
        .news-img {
            width: 100%;
            height: 180px;
        }
    }
</style>

<div class="news-page">
    
    <!-- Header -->
    <header class="news-header">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="news-title">Indeks Berita</h1>
            
            <form action="{{ route('news.index') }}" method="GET" class="search-box">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" name="q" value="{{ request('q') }}" class="search-input" placeholder="Cari berita atau pengumuman...">
            </form>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="flex flex-col lg:flex-row gap-10">
            
            <!-- Main Content: News List -->
            <main class="flex-1 min-w-0">
                @if(request('q'))
                    <div class="mb-6 text-sm text-gray-500">
                        Menampilkan hasil pencarian untuk: <span class="font-bold text-gray-900">"{{ request('q') }}"</span>
                        <a href="{{ route('news.index') }}" class="ml-2 text-green-600 hover:underline">(Reset)</a>
                    </div>
                @endif

                @forelse($articles as $article)
                    <a href="{{ route('article.show', $article->slug) }}" class="news-card">
                        @if($article->thumbnail)
                            <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="news-img" loading="lazy">
                        @else
                            <div class="news-img flex items-center justify-center text-3xl">📰</div>
                        @endif
                        <div class="news-content">
                            <span class="news-tag">Berita</span>
                            <h2 class="news-card-title">{{ $article->title }}</h2>
                            <div class="news-meta">
                                <span>{{ $article->created_at->translatedFormat('l, d F Y') }}</span>
                                <span>•</span>
                                <span>{{ number_format($article->views) }} Views</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="text-center py-20 bg-white border border-gray-200 rounded-xl">
                        <div class="text-4xl mb-4">🔍</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Berita Tidak Ditemukan</h3>
                        <p class="text-gray-500">Maaf, kami tidak dapat menemukan berita yang sesuai.</p>
                        @if(request('q'))
                            <a href="{{ route('news.index') }}" class="mt-4 inline-block text-green-600 font-semibold hover:underline">Kembali ke Indeks</a>
                        @endif
                    </div>
                @endforelse

                <!-- Pagination -->
                <div class="pagination-wrap">
                    {{ $articles->links() }}
                </div>
            </main>

            <!-- Sidebar -->
            <aside class="w-full lg:w-80 flex-shrink-0">
                
                <!-- Terpopuler -->
                <div class="widget-card sticky top-24">
                    <div class="widget-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Berita Terpopuler
                    </div>
                    <div>
                        @forelse($popularArticles as $index => $pop)
                            <a href="{{ route('article.show', $pop->slug) }}" class="pop-item">
                                <span class="pop-number">{{ $index + 1 }}</span>
                                <div>
                                    <h3 class="pop-title">{{ $pop->title }}</h3>
                                    <span class="text-xs text-gray-400 mt-2 block">{{ number_format($pop->views) }} Views</span>
                                </div>
                            </a>
                        @empty
                            <div class="p-4 text-sm text-gray-500 text-center">Belum ada berita terpopuler.</div>
                        @endforelse
                    </div>
                </div>

            </aside>

        </div>
    </div>
</div>

@endsection
