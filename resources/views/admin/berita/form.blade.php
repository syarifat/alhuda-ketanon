<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            {{ isset($berita) ? 'Edit Berita' : 'Tulis Berita Baru' }}
        </h2>
        <p class="text-sm text-gray-500 mt-1">{{ isset($berita) ? 'Perbarui konten artikel yang sudah ada.' : 'Buat konten berita atau artikel baru untuk website sekolah.' }}</p>
    </x-slot>

    {{-- Load Quill Rich Text Editor --}}
    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    @endpush

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ isset($berita) ? route('berita.update', $berita->id) : route('berita.store') }}" 
                  method="POST" enctype="multipart/form-data" id="beritaForm">
                @csrf
                @if(isset($berita)) @method('PUT') @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    {{-- Kolom Kiri: Editor Konten (2/3 lebar) --}}
                    <div class="lg:col-span-2 space-y-6">
                        
                        {{-- Judul --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                            <x-input-label value="Judul Berita / Artikel" class="font-bold text-gray-700 mb-2" />
                            <x-text-input name="judul" id="judul" class="block w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl text-lg transition-all"
                                :value="old('judul', $berita->judul ?? '')" required placeholder="Masukkan judul yang menarik..." />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        {{-- Konten Editor --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="font-bold text-gray-700 flex items-center">
                                    <span class="w-2 h-5 bg-sekolah-green rounded-full mr-3"></span>
                                    Isi Konten
                                </h3>
                            </div>
                            
                            {{-- Quill Editor Container --}}
                            <div id="quill-editor" style="min-height: 400px; font-size: 16px;">{!! old('konten', $berita->konten ?? '') !!}</div>
                            
                            {{-- Hidden input untuk menyimpan konten --}}
                            <textarea name="konten" id="konten-hidden" class="hidden" required>{{ old('konten', $berita->konten ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('konten')" class="mt-2 px-4 pb-2" />
                        </div>
                    </div>

                    {{-- Kolom Kanan: Pengaturan Sidebar --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Publikasi --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="font-bold text-gray-700">Publikasi</h3>
                            </div>
                            <div class="p-5 space-y-4">
                                <div>
                                    <x-input-label value="Status" class="font-semibold text-gray-700 text-sm" />
                                    <select name="status" class="block mt-2 w-full py-2.5 px-3 bg-gray-50 border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl text-sm font-medium transition-all">
                                        <option value="Draft" {{ old('status', $berita->status ?? 'Draft') === 'Draft' ? 'selected' : '' }}>📝 Draft (Tersimpan)</option>
                                        <option value="Publish" {{ old('status', $berita->status ?? '') === 'Publish' ? 'selected' : '' }}>🟢 Publish (Tampil di Website)</option>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label value="Tanggal Publikasi (Opsional)" class="font-semibold text-gray-700 text-sm" />
                                    <x-text-input type="datetime-local" name="tanggal_publikasi" class="block mt-2 w-full py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl text-sm transition-all"
                                        :value="old('tanggal_publikasi', isset($berita) && $berita->tanggal_publikasi ? $berita->tanggal_publikasi->format('Y-m-d\TH:i') : '')" />
                                    <p class="text-xs text-gray-400 mt-1">Kosongkan untuk menggunakan waktu sekarang saat publish.</p>
                                </div>
                                <div class="pt-2 border-t border-gray-100">
                                    <button type="submit" class="w-full flex justify-center items-center px-5 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5 active:scale-95">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                        {{ isset($berita) ? 'Simpan Perubahan' : 'Simpan Sekarang' }}
                                    </button>
                                    <a href="{{ route('berita.index') }}" class="block text-center mt-3 text-sm text-gray-500 hover:text-gray-700 font-medium transition-colors">Batal & Kembali</a>
                                </div>
                            </div>
                        </div>

                        {{-- Gambar Cover --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden" x-data="{ photoPreview: null }">
                            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="font-bold text-gray-700">Gambar Cover</h3>
                            </div>
                            <div class="p-5">
                                <div class="relative rounded-xl overflow-hidden bg-gray-50 border-2 border-dashed border-gray-300 hover:border-sekolah-green transition-colors group cursor-pointer"
                                     @click="$refs.coverInput.click()">
                                    
                                    <template x-if="!photoPreview">
                                        <div>
                                            @if(isset($berita) && $berita->gambar_cover)
                                                <img src="{{ Storage::disk('r2')->url($berita->gambar_cover) }}" class="w-full h-40 object-cover">
                                            @else
                                                <div class="h-40 flex flex-col items-center justify-center">
                                                    <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    <p class="text-xs text-gray-400 font-medium">Klik untuk upload gambar</p>
                                                    <p class="text-xs text-gray-300">JPG, PNG, WebP (Maks 4MB)</p>
                                                </div>
                                            @endif
                                        </div>
                                    </template>
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="w-full h-40 object-cover">
                                    </template>
                                    
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="text-white text-xs font-bold bg-sekolah-green px-3 py-1.5 rounded-lg">Ganti Cover</span>
                                    </div>
                                </div>
                                <input type="file" name="gambar_cover" x-ref="coverInput" class="hidden" accept="image/*"
                                    @change="
                                        const reader = new FileReader();
                                        reader.onload = (e) => { photoPreview = e.target.result; };
                                        reader.readAsDataURL($event.target.files[0]);
                                    ">
                                <x-input-error :messages="$errors->get('gambar_cover')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Kategori & Penulis --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                                <h3 class="font-bold text-gray-700">Kategorisasi</h3>
                            </div>
                            <div class="p-5 space-y-4">
                                <div>
                                    <x-input-label value="Kategori" class="font-semibold text-gray-700 text-sm" />
                                    <select name="kategori_id" class="block mt-2 w-full py-2.5 px-3 bg-gray-50 border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl text-sm font-medium transition-all">
                                        <option value="">— Tanpa Kategori —</option>
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->id }}" {{ old('kategori_id', $berita->kategori_id ?? '') == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($kategori->isEmpty())
                                        <p class="text-xs text-amber-600 mt-1">Belum ada kategori. 
                                            <a href="{{ route('kategori.index') }}" class="font-bold underline">Buat kategori dulu</a>
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    <x-input-label value="Penulis" class="font-semibold text-gray-700 text-sm" />
                                    <x-text-input name="penulis" class="block mt-2 w-full py-2.5 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl text-sm transition-all"
                                        :value="old('penulis', $berita->penulis ?? auth()->user()->name)" placeholder="Nama Penulis" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script>
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis konten berita di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['blockquote', 'code-block'],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });

        // Sinkronkan konten dari Quill ke hidden textarea sebelum form di-submit
        document.getElementById('beritaForm').addEventListener('submit', function() {
            document.getElementById('konten-hidden').value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-app-layout>
