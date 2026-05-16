<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                            <div>
                                <x-input-label for="title" :value="__('Judul Berita')" class="text-lg font-bold" />
                                <x-text-input id="title" class="block mt-2 w-full text-lg" type="text" name="title" :value="old('title', $article->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="content" :value="__('Isi Berita')" class="font-bold" />
                                <textarea id="content" name="content" rows="15" class="block mt-2 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('content', $article->content) }}</textarea>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                            <h3 class="text-md font-bold text-gray-900 border-b pb-2 mb-4">Pengaturan Publikasi</h3>
                            
                            <div class="mb-6">
                                <x-input-label :value="__('Thumbnail Saat Ini')" class="font-bold mb-2" />
                                @if($article->thumbnail)
                                    <div class="relative rounded-lg overflow-hidden border border-gray-200 mb-4 group">
                                        <img src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail" class="w-full h-auto object-cover aspect-video">
                                    </div>
                                @else
                                    <div class="p-4 bg-gray-50 text-center text-sm text-gray-500 rounded-lg mb-4 border border-dashed">
                                        Tidak ada gambar thumbnail.
                                    </div>
                                @endif

                                <x-input-label for="thumbnail" :value="__('Ganti Gambar (Opsional)')" class="font-bold mb-2 text-sm" />
                                <input id="thumbnail" name="thumbnail" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/jpeg, image/png, image/jpg">
                                <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah gambar saat ini.</p>
                                <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                            </div>

                            <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <label for="is_published" class="flex items-center cursor-pointer">
                                    <input id="is_published" type="checkbox" class="w-5 h-5 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-500" name="is_published" value="1" {{ $article->is_published ? 'checked' : '' }}>
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900">{{ __('Publikasikan') }}</span>
                                    </div>
                                </label>
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    Update Berita
                                </button>
                                <a href="{{ route('admin.articles.index') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for CKEditor 4 (Mendukung Align Text) -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            CKEDITOR.replace('content', {
                extraPlugins: 'justify,font,colorbutton,colordialog',
                height: 400,
                removeButtons: 'Image,About'
            });
        });
    </script>
</x-app-layout>