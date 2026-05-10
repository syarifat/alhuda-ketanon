<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-green-900 text-xl">Dashboard</h2>
    </x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.articles.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-blue-50 text-blue-600">📰</div>
                <span class="text-xs font-bold text-blue-400 bg-blue-50 px-2 py-0.5 rounded-full">Berita</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['articles'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stats['articles_pub'] }} dipublikasikan</p>
        </a>

        <a href="{{ route('admin.galleries.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-purple-50 text-purple-600">🖼️</div>
                <span class="text-xs font-bold text-purple-400 bg-purple-50 px-2 py-0.5 rounded-full">Galeri</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['galleries'] }}</p>
            <p class="text-xs text-gray-400 mt-1">foto kegiatan</p>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-green-50 text-green-600">✉️</div>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Pesan</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['messages'] }}</p>
            @if($stats['messages_unread'] > 0)
                <p class="text-xs text-green-600 font-bold mt-1">{{ $stats['messages_unread'] }} belum dibaca ✦</p>
            @else
                <p class="text-xs text-gray-400 mt-1">semua sudah dibaca</p>
            @endif
        </a>

        <a href="{{ route('admin.school-profile.edit') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-amber-50 text-amber-600">🏛️</div>
                <span class="text-xs font-bold text-amber-500 bg-amber-50 px-2 py-0.5 rounded-full">Profil</span>
            </div>
            <p class="text-lg font-black text-gray-800 leading-snug">Pengaturan Sekolah</p>
            <p class="text-xs text-gray-400 mt-1">klik untuk edit →</p>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Articles --}}
        <div class="admin-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-green-900">Berita Terbaru</h3>
                <a href="{{ route('admin.articles.index') }}" class="text-xs text-green-600 hover:text-green-800 font-bold">Lihat Semua →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentArticles as $article)
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-50 border border-transparent hover:border-green-100 transition-all">
                        @if($article->thumbnail)
                            <img src="{{ Storage::url($article->thumbnail) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0 shadow-sm" alt="">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-500 flex-shrink-0 text-sm">📰</div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ $article->title }}</p>
                            <p class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }}</p>
                        </div>
                        <span class="text-xs px-2 py-0.5 rounded-full font-bold {{ $article->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $article->is_published ? 'Publik' : 'Draft' }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 text-center py-6">Belum ada berita.</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Messages --}}
        <div class="admin-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-green-900">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-green-600 hover:text-green-800 font-bold">Lihat Semua →</a>
            </div>
            <div class="space-y-3">
                @forelse($recentMessages as $msg)
                    <a href="{{ route('admin.messages.show', $msg) }}"
                       class="flex items-start gap-3 p-3 rounded-xl {{ $msg->is_read ? 'bg-gray-50' : 'bg-green-50 border border-green-100' }} hover:bg-green-50 hover:border-green-100 border border-transparent transition-all block">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                            {{ strtoupper(substr($msg->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ $msg->name }}</p>
                                @if(!$msg->is_read)<span class="w-2 h-2 rounded-full bg-green-500 flex-shrink-0 inline-block"></span>@endif
                            </div>
                            <p class="text-xs text-gray-400 truncate">{{ $msg->content }}</p>
                        </div>
                        <span class="text-xs text-gray-400 flex-shrink-0">{{ $msg->created_at->diffForHumans() }}</span>
                    </a>
                @empty
                    <p class="text-sm text-gray-400 text-center py-6">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="mt-6 admin-card">
        <h3 class="text-sm font-black text-green-900 mb-4">Aksi Cepat</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.articles.create') }}" class="quick-btn bg-blue-600 hover:bg-blue-700">
                + Tulis Berita Baru
            </a>
            <a href="{{ route('admin.galleries.create') }}" class="quick-btn bg-purple-600 hover:bg-purple-700">
                + Upload Foto Galeri
            </a>
            <a href="{{ route('admin.school-profile.edit') }}" class="quick-btn bg-amber-500 hover:bg-amber-600">
                ✎ Edit Profil Sekolah
            </a>
            <a href="{{ route('home') }}" target="_blank" class="quick-btn bg-green-600 hover:bg-green-700">
                🌐 Lihat Website
            </a>
        </div>
    </div>

    <style>
        .admin-card {
            background: #fff; border: 1px solid #dcfce7; border-radius: 16px;
            padding: 20px; box-shadow: 0 2px 12px rgba(5,46,22,0.05);
            transition: box-shadow 0.2s, border-color 0.2s;
            display: block;
        }
        .admin-card:hover { box-shadow: 0 4px 24px rgba(22,163,74,0.12); border-color: #86efac; }
        .stat-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .quick-btn { color: #fff; font-size: 0.8rem; font-weight: 700; padding: 8px 18px; border-radius: 9999px; transition: all 0.2s; }
    </style>
</x-app-layout>
