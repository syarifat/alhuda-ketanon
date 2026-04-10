<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            Pesan Masuk
            @if($jumlahBelumDibaca > 0)
                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-500 text-white">
                    {{ $jumlahBelumDibaca }} Baru
                </span>
            @endif
        </h2>
        <p class="text-sm text-gray-500 mt-1">Daftar pesan yang masuk dari formulir Hubungi Kami di website.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 px-4 sm:px-0">
                <form method="GET" action="{{ route('pesan.index') }}" class="flex gap-3">
                    <select name="status" onchange="this.form.submit()" class="py-2 px-3 bg-white border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg text-sm font-medium">
                        <option value="">Semua Pesan</option>
                        <option value="belum_dibaca" {{ request('status') === 'belum_dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="sudah_dibaca" {{ request('status') === 'sudah_dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </form>

                @if($jumlahBelumDibaca > 0)
                    <form action="{{ route('pesan.tandai-dibaca') }}" method="POST">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                @endif
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-200 mx-4 sm:mx-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[600px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100">
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest w-3"></th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Pengirim</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Subjek</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Waktu</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($pesan as $p)
                                <tr class="transition-colors group {{ !$p->is_read ? 'bg-blue-50/40 hover:bg-blue-50/70' : 'hover:bg-gray-50/70' }}">
                                    <td class="pl-4 py-4">
                                        @if(!$p->is_read)
                                            <div class="w-2 h-2 rounded-full bg-sekolah-green"></div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-sekolah-green to-sekolah-green-dark flex items-center justify-center text-white font-bold text-sm shrink-0 shadow-sm">
                                                {{ strtoupper(substr($p->nama_pengirim, 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800 {{ !$p->is_read ? '' : 'font-medium' }}">{{ $p->nama_pengirim }}</p>
                                                <p class="text-xs text-gray-400">{{ $p->email_pengirim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="{{ !$p->is_read ? 'font-semibold text-gray-800' : 'text-gray-600' }}">
                                            {{ $p->subjek ?: '(Tanpa Subjek)' }}
                                        </p>
                                        <p class="text-xs text-gray-400 truncate max-w-xs">{{ Str::limit(strip_tags($p->isi_pesan), 60) }}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $p->tanggal_masuk->diffForHumans() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('pesan.show', $p->id) }}" 
                                               class="p-2 text-sekolah-green hover:bg-green-50 rounded-lg transition-colors" title="Baca Pesan">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>
                                            <form action="{{ route('pesan.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                        <p class="text-gray-400 font-medium">Tidak ada pesan yang ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pesan->hasPages())
                    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                        {{ $pesan->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
