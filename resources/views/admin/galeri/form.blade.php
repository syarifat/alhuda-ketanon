<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            {{ isset($galeri) ? 'Edit Item Galeri' : 'Tambah Item Galeri' }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">{{ isset($galeri) ? 'Perbarui informasi kegiatan yang sudah ada.' : 'Tambahkan dokumentasi kegiatan baru ke galeri sekolah.' }}</p>
    </x-slot>

    <div class="py-12" x-data="{ 
        tipeMedia: '{{ isset($galeri) && $galeri->isYoutube() ? 'youtube' : 'gambar' }}',
        photoPreview: null
    }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <form action="{{ isset($galeri) ? route('galeri.update', $galeri->id) : route('galeri.store') }}" 
                          method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @if(isset($galeri)) @method('PUT') @endif

                        {{-- Informasi Dasar --}}
                        <div>
                            <h3 class="text-lg font-bold text-sekolah-green-dark border-b pb-2 mb-6">Informasi Kegiatan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <x-input-label value="Judul Kegiatan" class="font-semibold text-gray-700" />
                                    <x-text-input name="judul_kegiatan" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all" 
                                        :value="old('judul_kegiatan', $galeri->judul_kegiatan ?? '')" required 
                                        placeholder="Contoh: Peringatan HUT Kemerdekaan RI" />
                                    <x-input-error :messages="$errors->get('judul_kegiatan')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label value="Tanggal Kegiatan" class="font-semibold text-gray-700" />
                                    <x-text-input type="date" name="tanggal_kegiatan" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all"
                                        :value="old('tanggal_kegiatan', isset($galeri) ? $galeri->tanggal_kegiatan->format('Y-m-d') : '')" required />
                                    <x-input-error :messages="$errors->get('tanggal_kegiatan')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label value="Deskripsi Singkat (Opsional)" class="font-semibold text-gray-700" />
                                    <textarea name="deskripsi_singkat" rows="3"
                                        class="block mt-2 w-full py-3 px-4 bg-gray-50 border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm resize-none"
                                        placeholder="Keterangan singkat tentang kegiatan...">{{ old('deskripsi_singkat', $galeri->deskripsi_singkat ?? '') }}</textarea>
                                    <x-input-error :messages="$errors->get('deskripsi_singkat')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Tipe Media --}}
                        <div>
                            <h3 class="text-lg font-bold text-sekolah-green-dark border-b pb-2 mb-6">Media Dokumentasi</h3>
                            
                            <div class="flex gap-4 mb-6">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="tipe_media" value="gambar" x-model="tipeMedia" class="sr-only">
                                    <div :class="tipeMedia === 'gambar' ? 'border-sekolah-green bg-green-50 ring-2 ring-sekolah-green' : 'border-gray-200 hover:border-gray-300'"
                                         class="p-4 border-2 rounded-xl transition-all text-center">
                                        <svg class="w-8 h-8 mx-auto mb-2" :class="tipeMedia === 'gambar' ? 'text-sekolah-green' : 'text-gray-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        <p class="font-bold text-sm" :class="tipeMedia === 'gambar' ? 'text-sekolah-green-dark' : 'text-gray-600'">Upload Gambar</p>
                                        <p class="text-xs text-gray-400">JPG, PNG, WebP</p>
                                    </div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="tipe_media" value="youtube" x-model="tipeMedia" class="sr-only">
                                    <div :class="tipeMedia === 'youtube' ? 'border-red-500 bg-red-50 ring-2 ring-red-500' : 'border-gray-200 hover:border-gray-300'"
                                         class="p-4 border-2 rounded-xl transition-all text-center">
                                        <svg class="w-8 h-8 mx-auto mb-2" :class="tipeMedia === 'youtube' ? 'text-red-600' : 'text-gray-400'" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-2.75 12.37 12.37 0 00-5.64 0A4.83 4.83 0 016.41 6.69 10.92 10.92 0 005 12a10.92 10.92 0 001.41 5.31 4.83 4.83 0 013.77 2.75 12.37 12.37 0 005.64 0 4.83 4.83 0 013.77-2.75A10.92 10.92 0 0021 12a10.92 10.92 0 00-1.41-5.31zM9.5 15.5v-7l6 3.5z"/></svg>
                                        <p class="font-bold text-sm" :class="tipeMedia === 'youtube' ? 'text-red-700' : 'text-gray-600'">Link YouTube</p>
                                        <p class="text-xs text-gray-400">Video dari YouTube</p>
                                    </div>
                                </label>
                            </div>

                            {{-- Upload Gambar --}}
                            <div x-show="tipeMedia === 'gambar'" x-transition>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-sekolah-green transition-colors" 
                                     x-data="{ photoPreview: null }">
                                    <template x-if="!photoPreview">
                                        <div>
                                            @if(isset($galeri) && !$galeri->isYoutube() && $galeri->media_path)
                                                <img src="{{ Storage::disk('r2')->url($galeri->media_path) }}" 
                                                     class="mx-auto h-40 object-cover rounded-lg mb-4">
                                                <p class="text-xs text-gray-500 mb-2">Gambar saat ini. Klik di bawah untuk mengganti.</p>
                                            @else
                                                <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            @endif
                                        </div>
                                    </template>
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="mx-auto h-48 object-cover rounded-lg mb-4">
                                    </template>
                                    
                                    <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                        Pilih File Gambar
                                        <input type="file" name="gambar" class="hidden" accept="image/*"
                                            @change="
                                                const reader = new FileReader();
                                                reader.onload = (e) => { photoPreview = e.target.result; };
                                                reader.readAsDataURL($event.target.files[0]);
                                            ">
                                    </label>
                                    <p class="text-xs text-gray-400 mt-2">Maksimal 4MB. Format: JPG, PNG, WebP</p>
                                </div>
                                <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                            </div>

                            {{-- Link YouTube --}}
                            <div x-show="tipeMedia === 'youtube'" x-transition>
                                <x-input-label value="URL Video YouTube" class="font-semibold text-gray-700" />
                                <x-text-input name="link_youtube" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-red-400 focus:ring-red-400 rounded-xl transition-all"
                                    :value="old('link_youtube', isset($galeri) && $galeri->isYoutube() ? $galeri->media_path : '')"
                                    placeholder="https://www.youtube.com/watch?v=..." />
                                <p class="text-xs text-gray-400 mt-1">Masukkan link penuh dari YouTube (bisa link biasa atau youtu.be)</p>
                                <x-input-error :messages="$errors->get('link_youtube')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col sm:flex-row justify-end items-center gap-4 pt-8 border-t border-gray-100">
                            <a href="{{ route('galeri.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-colors">
                                Batal & Kembali
                            </a>
                            <button type="submit" class="w-full sm:w-auto flex justify-center items-center px-8 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                {{ isset($galeri) ? 'Simpan Perubahan' : 'Tambah ke Galeri' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
