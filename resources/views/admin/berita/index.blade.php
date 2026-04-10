<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Berita & Artikel</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola semua konten berita, pengumuman, dan artikel untuk website sekolah.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header Aksi & Filter --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 px-4 sm:px-0">
                <form method="GET" action="{{ route('berita.index') }}" class="flex flex-wrap gap-3">
                    <select name="status" onchange="this.form.submit()" class="py-2 px-3 bg-white border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg text-sm font-medium">
                        <option value="">Semua Status</option>
                        <option value="Publish" {{ request('status') === 'Publish' ? 'selected' : '' }}>Publish</option>
                        <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                    <select name="kategori_id" onchange="this.form.submit()" class="py-2 px-3 bg-white border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg text-sm font-medium">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @if(request('status') || request('kategori_id'))
                        <a href="{{ route('berita.index') }}" class="py-2 px-3 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-sm font-medium transition-colors">Reset</a>
                    @endif
                </form>
                <a href="{{ route('berita.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white text-sm font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95 shrink-0">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tulis Berita Baru
                </a>
            </div>

            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mx-4 sm:mx-0 mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="text-green-800 font-semibold text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 mx-4 sm:mx-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Judul Berita</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Kategori</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($berita as $b)
                                <tr class="hover:bg-green-50/30 transition-colors group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if($b->gambar_cover)
                                                <img src="{{ Storage::disk('r2')->url($b->gambar_cover) }}" class="w-12 h-10 object-cover rounded-lg shrink-0">
                                            @else
                                                <div class="w-12 h-10 bg-gray-100 rounded-lg flex items-center justify-center shrink-0">
                                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-bold text-gray-800 group-hover:text-sekolah-green transition-colors line-clamp-1">{{ $b->judul }}</div>
                                                <div class="text-xs text-gray-400 font-medium">oleh {{ $b->penulis ?? 'Anonim' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($b->kategori)
                                            <span class="inline-block bg-gray-100 text-gray-600 text-xs font-semibold px-2.5 py-1 rounded-lg">{{ $b->kategori->nama_kategori }}</span>
                                        @else
                                            <span class="text-gray-400 text-xs italic">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($b->status === 'Publish')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 ring-1 ring-green-200">
                                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                                Publish
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 ring-1 ring-yellow-200">
                                                <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                                Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $b->tanggal_publikasi ? $b->tanggal_publikasi->format('d M Y') : $b->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('berita.edit', $b->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Berita">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                            <form action="{{ route('berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                                        <p class="text-gray-400 font-medium">Belum ada berita yang ditulis.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($berita->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        {{ $berita->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
