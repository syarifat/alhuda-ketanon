<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Detail Pesan</h2>
        <p class="text-sm text-gray-500 mt-1">Membaca isi pesan yang masuk dari pengunjung website.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 px-4 sm:px-0">
                <a href="{{ route('pesan.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-500 hover:text-sekolah-green transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Kembali ke Kotak Masuk
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mx-4 sm:mx-0">
                
                {{-- Header Pesan --}}
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-sekolah-green to-sekolah-green-dark flex items-center justify-center text-white font-extrabold text-xl shadow-lg">
                                {{ strtoupper(substr($pesan->nama_pengirim, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-extrabold text-gray-800 text-lg">{{ $pesan->nama_pengirim }}</p>
                                <a href="mailto:{{ $pesan->email_pengirim }}" class="text-sm text-sekolah-green hover:underline">{{ $pesan->email_pengirim }}</a>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-sm text-gray-500">{{ $pesan->tanggal_masuk->format('d M Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $pesan->tanggal_masuk->format('H:i') }} WIB</p>
                            <span class="inline-block mt-1 px-2.5 py-0.5 rounded-full text-xs font-bold {{ $pesan->is_read ? 'bg-gray-100 text-gray-500' : 'bg-green-100 text-green-700' }}">
                                {{ $pesan->is_read ? 'Sudah Dibaca' : 'Baru' }}
                            </span>
                        </div>
                    </div>

                    @if($pesan->subjek)
                        <div class="mt-6 pt-4 border-t border-gray-50">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Subjek</p>
                            <h3 class="text-xl font-bold text-gray-800">{{ $pesan->subjek }}</h3>
                        </div>
                    @endif
                </div>

                {{-- Isi Pesan --}}
                <div class="p-8">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Isi Pesan</p>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap bg-gray-50/70 rounded-xl p-6 border border-gray-100">{{ $pesan->isi_pesan }}</div>
                </div>

                {{-- Footer Aksi --}}
                <div class="p-6 bg-gray-50 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="mailto:{{ $pesan->email_pengirim }}?subject=Re: {{ $pesan->subjek }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" /></svg>
                        Balas via Email
                    </a>
                    <form action="{{ route('pesan.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 text-red-600 hover:bg-red-50 font-semibold rounded-xl transition-colors border border-red-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Hapus Pesan Ini
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
