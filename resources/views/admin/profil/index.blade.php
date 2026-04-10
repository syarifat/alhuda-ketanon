<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            Konfigurasi Profil Sekolah
        </h2>
        <p class="text-sm text-gray-500 mt-1">Sesuaikan identitas visual dan informasi publik sekolah Anda.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-8 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="text-green-800 font-bold text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            @endif

            <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                            Identitas & Logo
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                            <div class="md:col-span-2 space-y-6">
                                <div>
                                    <x-input-label value="Nama Resmi Sekolah" class="font-bold text-gray-700" />
                                    <x-text-input name="nama_sekolah" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all" :value="old('nama_sekolah', $profil->nama_sekolah)" required placeholder="Contoh: SMA Negeri 1 Tulungagung" />
                                </div>
                                <div class="p-4 bg-blue-50 rounded-xl border border-blue-100 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <p class="text-xs text-blue-700 leading-relaxed">Nama ini akan muncul di judul website, footer, dan kop surat sistem. Pastikan ejaan sudah benar.</p>
                                </div>
                            </div>

                            <div x-data="{ photoPreview: null }">
                                <x-input-label value="Logo Sekolah" class="font-bold text-gray-700 mb-2" />
                                <div class="relative group">
                                    <div class="w-full aspect-square rounded-2xl bg-gray-50 border-2 border-dashed border-gray-300 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-sekolah-green">
                                        <template x-if="!photoPreview">
                                            @if($profil->logo)
                                                <img src="{{ Storage::disk('r2')->url($profil->logo) }}" class="object-contain w-full h-full p-4">
                                            @else
                                                <div class="text-center p-4">
                                                    <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                                    <p class="mt-1 text-xs text-gray-500 font-medium">PNG, JPG up to 2MB</p>
                                                </div>
                                            @endif
                                        </template>
                                        <template x-if="photoPreview">
                                            <img :src="photoPreview" class="object-contain w-full h-full p-4">
                                        </template>
                                        
                                        <div @click="$refs.logoInput.click()" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                            <span class="text-white text-xs font-bold bg-sekolah-green px-3 py-1.5 rounded-lg">Ganti Logo</span>
                                        </div>
                                    </div>
                                    <input type="file" name="logo" x-ref="logoInput" class="hidden" 
                                        @change="
                                            const reader = new FileReader();
                                            reader.onload = (e) => { photoPreview = e.target.result; };
                                            reader.readAsDataURL($event.target.files[0]);
                                        ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                            Visi, Misi & Sejarah
                        </h3>
                    </div>
                    <div class="p-8 space-y-8">
                        <div>
                            <x-input-label value="Visi Sekolah" class="font-bold text-gray-700" />
                            <textarea name="visi" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" rows="2" placeholder="Masukkan visi sekolah...">{{ old('visi', $profil->visi) }}</textarea>
                        </div>
                        <div>
                            <x-input-label value="Misi Sekolah" class="font-bold text-gray-700" />
                            <p class="text-[10px] text-gray-400 mb-2 uppercase tracking-tight">* Gunakan baris baru untuk setiap poin misi</p>
                            <textarea name="misi" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" rows="6" placeholder="1. Melaksanakan pembelajaran...&#10;2. Mengembangkan bakat...">{{ old('misi', $profil->misi) }}</textarea>
                        </div>
                        <div>
                            <x-input-label value="Sejarah Singkat Sekolah" class="font-bold text-gray-700" />
                            <textarea name="sejarah_singkat" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" rows="6" placeholder="Tuliskan sejarah berdirinya sekolah...">{{ old('sejarah_singkat', $profil->sejarah_singkat) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                            Profil Kepala Sekolah
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row gap-10">
                            <div x-data="{ photoPreview: null }" class="flex-shrink-0">
                                <div class="relative group w-48 h-64 mx-auto">
                                    <div class="w-full h-full rounded-2xl bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden transition-all group-hover:border-sekolah-green shadow-inner">
                                        <template x-if="!photoPreview">
                                            @if($profil->foto_kepala_sekolah)
                                                <img src="{{ Storage::disk('r2')->url($profil->foto_kepala_sekolah) }}" class="object-cover w-full h-full">
                                            @else
                                                <div class="text-center p-4">
                                                    <svg class="mx-auto h-10 w-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                    <p class="mt-2 text-[10px] text-gray-400 font-bold uppercase">Pas Foto</p>
                                                </div>
                                            @endif
                                        </template>
                                        <template x-if="photoPreview">
                                            <img :src="photoPreview" class="object-cover w-full h-full">
                                        </template>

                                        <div @click="$refs.fotoInput.click()" class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                            <span class="text-white text-xs font-bold bg-sekolah-green px-3 py-1.5 rounded-lg">Ganti Foto</span>
                                        </div>
                                    </div>
                                    <input type="file" name="foto_kepala_sekolah" x-ref="fotoInput" class="hidden" 
                                        @change="
                                            const reader = new FileReader();
                                            reader.onload = (e) => { photoPreview = e.target.result; };
                                            reader.readAsDataURL($event.target.files[0]);
                                        ">
                                </div>
                            </div>

                            <div class="flex-1 space-y-6">
                                <div>
                                    <x-input-label value="Nama Lengkap Kepala Sekolah" class="font-bold text-gray-700" />
                                    <x-text-input name="nama_kepala_sekolah" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all" :value="old('nama_kepala_sekolah', $profil->nama_kepala_sekolah)" placeholder="Beserta gelar akademik..." />
                                </div>
                                <div>
                                    <x-input-label value="Kalimat Sambutan" class="font-bold text-gray-700" />
                                    <textarea name="sambutan_kepala_sekolah" class="block mt-2 w-full py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" rows="6" placeholder="Tuliskan kata sambutan untuk pengunjung website...">{{ old('sambutan_kepala_sekolah', $profil->sambutan_kepala_sekolah) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center sm:justify-end pb-20">
                    <button type="submit" class="w-full sm:w-auto flex justify-center items-center px-12 py-4 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-extrabold rounded-2xl shadow-xl shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                        Simpan Semua Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>