<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-3">
            <h2 class="font-black text-green-900 text-xl">{{ __('Galeri Kegiatan') }}</h2>
            <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary inline-flex items-center gap-1.5">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Foto</span>
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

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
        @forelse ($galleries as $item)
            <div class="bg-white border border-green-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:border-green-300 transition-all group">
                <div class="relative aspect-square overflow-hidden bg-green-50">
                    <img src="{{ Storage::url($item->image_path) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500" alt="{{ $item->title }}">
                    <!-- Overlay buttons -->
                    <div class="absolute inset-0 bg-green-950/60 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center gap-2">
                        <a href="{{ route('admin.galleries.edit', $item) }}"
                           class="w-9 h-9 rounded-full bg-yellow-400 hover:bg-yellow-300 flex items-center justify-center text-yellow-900 shadow-lg transition-all"
                           title="Edit">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 rounded-full bg-red-500 hover:bg-red-400 flex items-center justify-center text-white shadow-lg transition-all" title="Hapus">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-3">
                    <p class="font-bold text-green-900 text-sm truncate">{{ $item->title }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $item->created_at->format('d M Y') }}</p>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center bg-white border-2 border-dashed border-green-200 rounded-2xl text-green-400">
                <div class="w-14 h-14 bg-green-50 border border-green-100 rounded-2xl flex items-center justify-center mx-auto mb-3 text-green-600 shadow-sm">
                    <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-500">Belum ada foto kegiatan.</p>
                <a href="{{ route('admin.galleries.create') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-green-600 hover:underline">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Upload foto pertama</span>
                </a>
            </div>
        @endforelse
    </div>

    @if($galleries->hasPages())
        <div class="mt-6">{{ $galleries->links() }}</div>
    @endif

    <style>
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.8rem; font-weight:800; padding:9px 20px; border-radius:9999px; box-shadow:0 2px 10px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; }
        .admin-btn-primary:hover { box-shadow:0 4px 16px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>