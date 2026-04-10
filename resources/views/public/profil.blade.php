@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')

{{-- Header Banner --}}
<div class="bg-gray-900 border-b border-gray-800 pt-10 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-sekolah-green via-gray-900 to-gray-900"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight mb-4">Profil Sekolah</h1>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto">Mengenal lebih dekat {{ $profil->nama_sekolah ?? 'sekolah kami' }}, sejarah, serta visi misi yang kami bawa untuk masa depan.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-24">
    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 lg:gap-8">
            
            {{-- Bagian Kiri: Info Utama --}}
            <div class="lg:col-span-4 bg-gray-50 p-8 md:p-12 border-r border-gray-100 flex flex-col justify-center text-center lg:text-left">
                @if($profil && $profil->logo)
                    <img src="{{ Storage::disk('r2')->url($profil->logo) }}" alt="Logo Sekolah" class="w-32 h-auto mx-auto lg:mx-0 mb-8 p-2 bg-white rounded-2xl shadow-sm border border-gray-100">
                @endif
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $profil->nama_sekolah ?? 'Nama Sekolah Belum Diatur' }}</h2>
                <div class="flex flex-wrap justify-center lg:justify-start gap-2 mb-8">
                    @if($profil && $profil->npsn)
                        <span class="px-3 py-1 bg-green-100 text-sekolah-green-dark text-xs font-bold rounded-lg">NPSN: {{ $profil->npsn }}</span>
                    @endif
                    @if($profil && $profil->nss)
                        <span class="px-3 py-1 bg-green-100 text-sekolah-green-dark text-xs font-bold rounded-lg">NSS: {{ $profil->nss }}</span>
                    @endif
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Kepala Sekolah</p>
                        <p class="text-lg font-bold text-gray-800">{{ $profil->nama_kepala_sekolah ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Sejarah & Visi Misi --}}
            <div class="lg:col-span-8 p-8 md:p-12 space-y-12">
                
                @if($profil && $profil->sambutan_kepala_sekolah)
                <div class="bg-green-50 rounded-2xl p-6 md:p-8 border border-green-100 relative">
                    <svg class="absolute top-4 right-4 w-12 h-12 text-green-200/50" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                    <div class="flex items-center gap-4 mb-4">
                        @if($profil->foto_kepala_sekolah)
                            <img src="{{ Storage::disk('r2')->url($profil->foto_kepala_sekolah) }}" alt="Kepala Sekolah" class="w-16 h-16 rounded-full object-cover shadow-sm ring-2 ring-white">
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-sekolah-green-dark">Sambutan Kepala Sekolah</h3>
                            <p class="text-sm text-gray-500 font-medium">{{ $profil->nama_kepala_sekolah }}</p>
                        </div>
                    </div>
                    <div class="prose prose-sm md:prose-base text-gray-600 leading-relaxed italic">
                        {!! nl2br(e($profil->sambutan_kepala_sekolah)) !!}
                    </div>
                </div>
                @endif

                @if($profil && ($profil->visi || $profil->misi))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($profil->visi)
                    <div class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-100">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-sekolah-green mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-4">Visi Sekolah</h3>
                        <div class="prose prose-sm text-gray-600">
                            {!! nl2br(e($profil->visi)) !!}
                        </div>
                    </div>
                    @endif

                    @if($profil->misi)
                    <div class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-100">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-sekolah-green mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-xl font-extrabold text-gray-900 mb-4">Misi Sekolah</h3>
                        <div class="prose prose-sm text-gray-600">
                            {!! nl2br(e($profil->misi)) !!}
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                @if($profil && $profil->sejarah_singkat)
                <div class="pt-8 border-t border-gray-100">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-sekolah-green rounded-full"></span>
                        Sejarah Singkat
                    </h3>
                    <div class="prose prose-lg text-gray-600 leading-relaxed max-w-none">
                        {!! nl2br(e($profil->sejarah_singkat)) !!}
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
