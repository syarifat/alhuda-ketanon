<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-black text-green-900 text-xl">Manajemen Berita</h2>
            <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Berita</span>
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium flex items-center gap-2">
            <svg class="w-4 h-4 text-green-600 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="admin-card overflow-hidden p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-green-100 bg-green-50/60">
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center w-14">No</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center w-20">Gambar</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider">Judul Berita</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center hidden sm:table-cell">Status</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center hidden md:table-cell">Views</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center hidden lg:table-cell">Tanggal</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-50">
                    @forelse ($articles as $index => $article)
                        <tr class="hover:bg-green-50/40 transition-colors">
                            <td class="px-5 py-4 text-center text-sm text-gray-400 font-medium">{{ $articles->firstItem() + $index }}</td>
                            <td class="px-5 py-4 text-center">
                                @if($article->thumbnail)
                                    <img src="{{ Storage::url($article->thumbnail) }}" class="w-14 h-14 object-cover rounded-xl mx-auto shadow-sm border border-green-100" alt="">
                                @else
                                    <div class="w-14 h-14 bg-green-50 border border-green-100 rounded-xl mx-auto flex items-center justify-center text-green-400">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                            <path d="M18 14h-8"/>
                                            <path d="M15 18h-5"/>
                                            <path d="M10 6h8v4h-8V6Z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-800 truncate max-w-xs md:max-w-sm">{{ $article->title }}</p>
                                <p class="text-xs mt-1 sm:hidden {{ $article->is_published ? 'text-green-600' : 'text-yellow-600' }} font-bold">
                                    {{ $article->is_published ? 'Published' : 'Draft' }}
                                </p>
                            </td>
                            <td class="px-5 py-4 text-center hidden sm:table-cell">
                                @if($article->is_published)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Published</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Draft</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center text-sm text-gray-500 hidden md:table-cell">{{ number_format($article->views) }}</td>
                            <td class="px-5 py-4 text-center text-xs text-gray-400 hidden lg:table-cell">{{ $article->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-full transition-all">
                                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-full transition-all">
                                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                                <div class="w-14 h-14 rounded-2xl bg-green-50 border border-green-100 flex items-center justify-center text-green-400 mx-auto mb-3">
                                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/>
                                        <path d="M18 14h-8"/>
                                        <path d="M15 18h-5"/>
                                        <path d="M10 6h8v4h-8V6Z"/>
                                    </svg>
                                </div>
                                <p class="font-semibold">Belum ada berita.</p>
                                <a href="{{ route('admin.articles.create') }}" class="mt-3 inline-block text-xs font-bold text-green-600 hover:underline">+ Tulis berita pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($articles->hasPages())
            <div class="px-5 py-4 border-t border-green-50">{{ $articles->links() }}</div>
        @endif
    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:16px; padding:20px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.8rem; font-weight:800; padding:9px 20px; border-radius:9999px; box-shadow:0 2px 10px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; }
        .admin-btn-primary:hover { box-shadow:0 4px 16px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>