<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-black text-green-900 text-xl">Manajemen Berita</h2>
            <a href="{{ route('admin.articles.create') }}" class="admin-btn-primary">+ Tambah Berita</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium flex items-center gap-2">
            <span class="text-green-500 text-base">✓</span> {{ session('success') }}
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
                                    <div class="w-14 h-14 bg-green-50 border border-green-100 rounded-xl mx-auto flex items-center justify-center text-green-300 text-lg">📰</div>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-800 truncate max-w-xs md:max-w-sm">{{ $article->title }}</p>
                                <p class="text-xs mt-1 sm:hidden {{ $article->is_published ? 'text-green-600' : 'text-yellow-600' }} font-bold">
                                    {{ $article->is_published ? '● Published' : '● Draft' }}
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
                                        ✎ Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-full transition-all">
                                            🗑 Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center text-gray-400">
                                <div class="text-4xl mb-3">📰</div>
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