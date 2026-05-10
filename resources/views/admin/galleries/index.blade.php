<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-3">
            <h2 class="font-black text-green-900 text-xl">{{ __('Galeri Kegiatan') }}</h2>
            <a href="{{ route('admin.galleries.create') }}" class="admin-btn-primary">+ Tambah Foto</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
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
                           class="w-9 h-9 rounded-full bg-yellow-400 hover:bg-yellow-300 flex items-center justify-center text-yellow-900 text-sm shadow-lg transition-all"
                           title="Edit">✎</a>
                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-9 h-9 rounded-full bg-red-500 hover:bg-red-400 flex items-center justify-center text-white text-sm shadow-lg transition-all" title="Hapus">🗑</button>
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
                <div class="text-4xl mb-3">🖼️</div>
                <p class="font-semibold text-gray-500">Belum ada foto kegiatan.</p>
                <a href="{{ route('admin.galleries.create') }}" class="mt-3 inline-block text-xs font-bold text-green-600 hover:underline">+ Upload foto pertama</a>
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