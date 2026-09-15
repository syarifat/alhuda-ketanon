<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-green-900 text-xl">Dashboard</h2>
    </x-slot>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.articles.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-blue-50 text-blue-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                        <path d="M18 14h-8"/>
                        <path d="M15 18h-5"/>
                        <path d="M10 6h8v4h-8V6Z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-blue-400 bg-blue-50 px-2 py-0.5 rounded-full">Berita</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['articles'] }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $stats['articles_pub'] }} dipublikasikan</p>
        </a>

        <a href="{{ route('admin.galleries.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-purple-50 text-purple-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-purple-400 bg-purple-50 px-2 py-0.5 rounded-full">Galeri</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['galleries'] }}</p>
            <p class="text-xs text-gray-400 mt-1">foto kegiatan</p>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-green-50 text-green-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">Pesan</span>
            </div>
            <p class="text-3xl font-black text-gray-800">{{ $stats['messages'] }}</p>
            @if($stats['messages_unread'] > 0)
                <p class="text-xs text-green-600 font-bold mt-1 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse inline-block"></span>
                    <span>{{ $stats['messages_unread'] }} belum dibaca</span>
                </p>
            @else
                <p class="text-xs text-gray-400 mt-1">semua sudah dibaca</p>
            @endif
        </a>

        <a href="{{ route('admin.school-profile.edit') }}" class="admin-card group">
            <div class="flex items-center justify-between mb-3">
                <div class="stat-icon bg-amber-50 text-amber-600">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 21h18M3 7v14M21 7v14M6 11h4M6 15h4M14 11h4M14 15h4M12 3l9 4H3l9-4z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-amber-500 bg-amber-50 px-2 py-0.5 rounded-full">Profil</span>
            </div>
            <p class="text-lg font-black text-gray-800 leading-snug">Pengaturan Sekolah</p>
            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                <span>klik untuk edit</span>
                <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
            </p>
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Articles --}}
        <div class="admin-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-black text-green-900">Berita Terbaru</h3>
                <a href="{{ route('admin.articles.index') }}" class="text-xs text-green-600 hover:text-green-800 font-bold inline-flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="space-y-3">
                @forelse($recentArticles as $article)
                    <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 hover:bg-green-50 border border-transparent hover:border-green-100 transition-all">
                        @if($article->thumbnail)
                            <img src="{{ Storage::url($article->thumbnail) }}" class="w-10 h-10 rounded-lg object-cover flex-shrink-0 shadow-sm" alt="">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                    <path d="M18 14h-8"/>
                                    <path d="M15 18h-5"/>
                                    <path d="M10 6h8v4h-8V6Z"/>
                                </svg>
                            </div>
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
                <a href="{{ route('admin.messages.index') }}" class="text-xs text-green-600 hover:text-green-800 font-bold inline-flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7"/>
                    </svg>
                </a>
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
            <a href="{{ route('admin.articles.create') }}" class="quick-btn bg-blue-600 hover:bg-blue-700 inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tulis Berita Baru</span>
            </a>
            <a href="{{ route('admin.galleries.create') }}" class="quick-btn bg-purple-600 hover:bg-purple-700 inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Upload Foto Galeri</span>
            </a>
            <a href="{{ route('admin.school-profile.edit') }}" class="quick-btn bg-amber-500 hover:bg-amber-600 inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                <span>Edit Profil Sekolah</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="quick-btn bg-green-600 hover:bg-green-700 inline-flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                </svg>
                <span>Lihat Website</span>
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
