@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')

{{-- Header Banner --}}
<div class="bg-gray-900 border-b border-gray-800 pt-10 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-sekolah-green via-gray-900 to-gray-900"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Hubungi Kami</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">Kami mengundang Anda untuk berkomunikasi, bertanya, atau memberikan saran demi kemajuan bersama.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-24">
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Info Kontak --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl shadow-green-900/5 border border-gray-100 p-8 h-full flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-full blur-3xl -mr-16 -mt-16 z-0"></div>
                <div class="relative z-10">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-8 border-b border-gray-100 pb-4">Informasi Kontak</h3>
                    
                    <ul class="space-y-6">
                        @if($kontak && $kontak->alamat_lengkap)
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-sekolah-green shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1">Alamat Sekolah</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $kontak->alamat_lengkap }}</p>
                            </div>
                        </li>
                        @endif

                        @if($kontak && $kontak->no_telepon)
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-sekolah-green shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1">Telepon/WhatsApp</h4>
                                <a href="tel:{{ $kontak->no_telepon }}" class="text-sm text-sekolah-green hover:underline font-medium">{{ $kontak->no_telepon }}</a>
                            </div>
                        </li>
                        @endif

                        @if($kontak && $kontak->email_sekolah)
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-sekolah-green shrink-0">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-900 mb-1">Email Resmi</h4>
                                <a href="mailto:{{ $kontak->email_sekolah }}" class="text-sm text-sekolah-green hover:underline font-medium">{{ $kontak->email_sekolah }}</a>
                            </div>
                        </li>
                        @endif
                    </ul>

                    {{-- Social Media Links --}}
                    @if($kontak && ($kontak->link_facebook || $kontak->link_instagram || $kontak->link_youtube))
                    <div class="mt-10 pt-6 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-gray-900 mb-4">Temukan Kami di Sosial Media</h4>
                        <div class="flex gap-3">
                            @if($kontak->link_facebook)
                            <a href="{{ $kontak->link_facebook }}" target="_blank" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                            </a>
                            @endif
                            @if($kontak->link_instagram)
                            <a href="{{ $kontak->link_instagram }}" target="_blank" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 text-sm hover:bg-gradient-to-tr hover:from-yellow-400 hover:via-red-500 hover:to-purple-500 hover:text-white transition-all">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/></svg>
                            </a>
                            @endif
                            @if($kontak->link_youtube)
                            <a href="{{ $kontak->link_youtube }}" target="_blank" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 hover:bg-red-600 hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Form Pesan --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-3xl shadow-xl shadow-green-900/5 border border-gray-100 p-8 md:p-12 h-full">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Punya pertanyaan untuk kami?</h3>
                <p class="text-gray-500 mb-8">Silakan lengkapi form di bawah ini dan kami akan segera membalas pesan Anda.</p>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-3 animate-pulse">
                        <div class="bg-white p-2 rounded-lg text-green-600 shadow-sm"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                        <span class="text-green-800 font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('public.kirim-pesan') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_pengirim" required value="{{ old('nama_pengirim') }}" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-sekolah-green focus:ring focus:ring-green-100 transition-all bg-gray-50 focus:bg-white" 
                                placeholder="Contoh: Budi Santoso">
                            @error('nama_pengirim') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email_pengirim" required value="{{ old('email_pengirim') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-sekolah-green focus:ring focus:ring-green-100 transition-all bg-gray-50 focus:bg-white" 
                                placeholder="Contoh: budi@email.com">
                            @error('email_pengirim') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Subjek Pesan (Opsional)</label>
                        <input type="text" name="subjek" value="{{ old('subjek') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-sekolah-green focus:ring focus:ring-green-100 transition-all bg-gray-50 focus:bg-white" 
                            placeholder="Perihal yang ingin ditanyakan">
                        @error('subjek') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Isi Pesan <span class="text-red-500">*</span></label>
                        <textarea name="isi_pesan" required rows="5"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-sekolah-green focus:ring focus:ring-green-100 transition-all bg-gray-50 focus:bg-white resize-none" 
                            placeholder="Tuliskan pertanyaan, keluhan, atau masukan Anda di sini...">{{ old('isi_pesan') }}</textarea>
                        @error('isi_pesan') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto btn-primary px-10 py-3.5 text-base shadow-xl group">
                            Kirim Pesan Sekarang
                            <svg class="w-5 h-5 ml-2 transform group-hover:-translate-y-1 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- Maps Area --}}
    @if($kontak && $kontak->koordinat_maps)
    <div class="mt-12 bg-white rounded-3xl shadow-md border border-gray-100 p-2 overflow-hidden h-96">
        <iframe 
            src="{{ $kontak->koordinat_maps }}" 
            width="100%" height="100%" style="border:0; border-radius: 1.25rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    @endif

</div>

@endsection
