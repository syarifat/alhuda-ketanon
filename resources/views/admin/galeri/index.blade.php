<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Galeri Kegiatan</h2>
        <p class="text-sm text-gray-500 mt-1">Dokumentasikan setiap momen berharga kegiatan sekolah Anda.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end mb-6 px-4 sm:px-0">
                <a href="{{ route('galeri.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white text-sm font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Item Galeri
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

            @if($galeri->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-16 text-center mx-4 sm:mx-0">
                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <h3 class="text-lg font-bold text-gray-500 mb-2">Galeri Masih Kosong</h3>
                    <p class="text-sm text-gray-400">Klik tombol "+ Tambah Item Galeri" untuk memulai mendokumentasikan kegiatan sekolah.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-4 sm:px-0">
                    @foreach($galeri as $item)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden group hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                            
                            {{-- Thumbnail Media --}}
                            <div class="relative h-48 bg-gray-100 overflow-hidden">
                                @if($item->isYoutube())
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-red-50 to-red-100">
                                        <div class="text-center">
                                            <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-2 shadow-lg">
                                                <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                            </div>
                                            <span class="text-xs font-bold text-red-600">VIDEO YOUTUBE</span>
                                        </div>
                                    </div>
                                @else
                                    <img src="{{ Storage::disk('r2')->url($item->media_path) }}" 
                                         alt="{{ $item->judul_kegiatan }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @endif
                                
                                {{-- Date Badge --}}
                                <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-sekolah-green-dark text-xs font-bold px-2.5 py-1 rounded-lg shadow-sm">
                                    {{ $item->tanggal_kegiatan->translatedFormat('d M Y') ?? $item->tanggal_kegiatan->format('d M Y') }}
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-5">
                                <h3 class="font-bold text-gray-800 group-hover:text-sekolah-green transition-colors mb-1 line-clamp-2">
                                    {{ $item->judul_kegiatan }}
                                </h3>
                                @if($item->deskripsi_singkat)
                                    <p class="text-sm text-gray-500 line-clamp-2">{{ $item->deskripsi_singkat }}</p>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="px-5 pb-5 flex items-center gap-2 border-t border-gray-50 pt-4">
                                <a href="{{ route('galeri.edit', $item->id) }}" 
                                   class="flex-1 flex items-center justify-center gap-2 py-2 text-blue-500 hover:bg-blue-50 rounded-lg text-sm font-semibold transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                    Edit
                                </a>
                                <form action="{{ route('galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus item galeri ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="flex items-center justify-center gap-2 px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg text-sm font-semibold transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 px-4 sm:px-0">
                    {{ $galeri->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
