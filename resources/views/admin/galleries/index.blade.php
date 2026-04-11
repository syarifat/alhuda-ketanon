<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Galeri Kegiatan') }}</h2>
            <a href="{{ route('admin.galleries.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-bold shadow">+ Tambah Foto</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($galleries as $item)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 group">
                        <div class="relative">
                            <img src="{{ Storage::disk('r2')->url($item->image_path) }}" class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700 shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 truncate">{{ $item->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 text-center bg-white rounded-lg border-2 border-dashed text-gray-400">Belum ada foto kegiatan.</div>
                @endforelse
            </div>
            <div class="mt-6">{{ $galleries->links() }}</div>
        </div>
    </div>
</x-app-layout>