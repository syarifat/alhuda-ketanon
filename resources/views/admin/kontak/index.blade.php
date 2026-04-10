<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Informasi Kontak</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola alamat fisik, kontak digital, dan link sosial media sekolah.</p>
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
                </div>
            @endif

            <form action="{{ route('kontak.update') }}" method="POST" class="space-y-8">
                @csrf
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                            Lokasi & Alamat
                        </h3>
                    </div>
                    <div class="p-8 space-y-6">
                        <div>
                            <x-input-label value="Alamat Lengkap Sekolah" class="font-bold text-gray-700" />
                            <textarea name="alamat_lengkap" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" rows="3" placeholder="Jl. Raya Ketanon No. XX, Kedungwaru, Tulungagung...">{{ old('alamat_lengkap', $kontak->alamat_lengkap) }}</textarea>
                        </div>
                        <div>
                            <x-input-label value="Embed Google Maps (Iframe)" class="font-bold text-gray-700" />
                            <p class="text-[10px] text-gray-400 mb-2 uppercase tracking-tight">* Masukkan kode <iframe> dari fitur 'Share > Embed Map' Google Maps</p>
                            <textarea name="embed_maps" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm font-mono text-xs" rows="4">{{ old('embed_maps', $kontak->embed_maps) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                            Kontak & Media Sosial
                        </h3>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <x-input-label value="Email Sekolah" class="font-bold text-gray-700" />
                                <x-text-input name="email_sekolah" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl" :value="old('email_sekolah', $kontak->email_sekolah)" placeholder="info@sekolah.sch.id" />
                            </div>
                            <div>
                                <x-input-label value="No. Telepon / WhatsApp" class="font-bold text-gray-700" />
                                <x-text-input name="no_telepon" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl" :value="old('no_telepon', $kontak->no_telepon)" placeholder="0812xxxxxx" />
                            </div>
                            <div>
                                <x-input-label value="Link Instagram" class="font-bold text-gray-700" />
                                <x-text-input name="link_instagram" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl" :value="old('link_instagram', $kontak->link_instagram)" placeholder="https://instagram.com/sekolah" />
                            </div>
                            <div>
                                <x-input-label value="Link YouTube" class="font-bold text-gray-700" />
                                <x-text-input name="link_youtube" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl" :value="old('link_youtube', $kontak->link_youtube)" placeholder="https://youtube.com/c/sekolah" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pb-20">
                    <button type="submit" class="w-full sm:w-auto px-12 py-4 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-extrabold rounded-2xl shadow-xl shadow-green-100 transition-all transform hover:-translate-y-1">
                        Perbarui Info Kontak
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>