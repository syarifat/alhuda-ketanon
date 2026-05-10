<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Foto Kegiatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-100">
                            <div>
                                <x-input-label for="title" :value="__('Judul Kegiatan')" class="text-lg font-bold" />
                                <x-text-input id="title" class="block mt-2 w-full text-lg" type="text" name="title" :value="old('title', $gallery->title)" placeholder="Misal: Lomba 17 Agustus 2024" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="description" :value="__('Deskripsi Singkat (Opsional)')" class="font-bold" />
                                <textarea id="description" name="description" rows="5" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Tuliskan sedikit cerita atau keterangan tentang foto ini...">{{ old('description', $gallery->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-100">
                            <h3 class="text-md font-bold text-gray-900 border-b pb-2 mb-4">Upload Foto Baru (Opsional)</h3>
                            
                            <div class="mb-4">
                                <p class="text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini:</p>
                                <img src="{{ Storage::disk('r2')->url($gallery->image_path) }}" class="w-full h-auto rounded-md shadow-sm border" alt="{{ $gallery->title }}">
                            </div>

                            <div class="mb-6">
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center mt-2">
                                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 px-3 py-1 border border-indigo-200">
                                                <span>Pilih File Gambar</span>
                                                <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png, image/jpg">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto.<br>Format: PNG, JPG, JPEG (Maks. 3MB)</p>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    Simpan Perubahan
                                </button>
                                <a href="{{ route('admin.galleries.index') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
