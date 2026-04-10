<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">Kategori Berita</h2>
        <p class="text-sm text-gray-500 mt-1">Kelompokkan artikel dan berita sekolah Anda agar lebih rapi.</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-2xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-2 rounded-lg mr-3">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </div>
                        <span class="text-green-800 font-bold text-sm">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden sticky top-6">
                        <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                                <span class="w-2 h-6 bg-sekolah-green rounded-full mr-3"></span>
                                Tambah Kategori
                            </h3>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('kategori.store') }}" method="POST">
                                @csrf
                                <div>
                                    <x-input-label value="Nama Kategori" class="font-bold text-gray-700" />
                                    <x-text-input name="nama_kategori" class="block mt-2 w-full px-4 py-3 bg-gray-50 border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-xl transition-all shadow-sm" required placeholder="Cth: Pengumuman" />
                                    <x-input-error :messages="$errors->get('nama_kategori')" class="mt-2" />
                                </div>
                                <div class="mt-6">
                                    <button type="submit" class="w-full flex justify-center items-center px-4 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-0.5">
                                        + Simpan Kategori
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-gray-200">
                        <div class="p-0">
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-50 border-b border-gray-100">
                                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Nama Kategori</th>
                                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Slug (URL)</th>
                                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @forelse($kategori as $k)
                                        <tr class="hover:bg-green-50/30 transition-colors group" x-data="{ editing: false }">
                                            
                                            <td class="px-6 py-4 whitespace-nowrap" x-show="!editing">
                                                <div class="font-bold text-gray-800">{{ $k->nama_kategori }}</div>
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap" x-show="editing" x-cloak colspan="2">
                                                <form action="{{ route('kategori.update', $k->id) }}" method="POST" class="flex gap-2">
                                                    @csrf @method('PUT')
                                                    <input type="text" name="nama_kategori" value="{{ $k->nama_kategori }}" class="w-full px-3 py-2 bg-white border border-gray-300 focus:border-sekolah-green focus:ring-sekolah-green rounded-lg text-sm">
                                                    <button type="submit" class="px-3 py-2 bg-sekolah-green text-white text-sm font-bold rounded-lg hover:bg-sekolah-green-dark">Simpan</button>
                                                    <button type="button" @click="editing = false" class="px-3 py-2 bg-gray-200 text-gray-700 text-sm font-bold rounded-lg hover:bg-gray-300">Batal</button>
                                                </form>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap" x-show="!editing">
                                                <span class="inline-block bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-md font-mono">{{ $k->slug }}</span>
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-center" x-show="!editing">
                                                <div class="flex items-center justify-center gap-2">
                                                    <button @click="editing = true" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                                    </button>
                                                    
                                                    <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                                                Belum ada kategori yang ditambahkan.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>