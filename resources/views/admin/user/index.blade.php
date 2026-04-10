<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 tracking-tight">
            Manajemen Pengguna
        </h2>
        <p class="text-sm text-gray-500 mt-1">Daftar staf yang memiliki akses ke panel kontrol CMS.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-end mb-6 px-4 sm:px-0">
                <a href="{{ route('user.create') }}" class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-3 bg-sekolah-green hover:bg-sekolah-green-dark text-white text-sm font-bold rounded-xl shadow-lg shadow-green-100 transition-all transform hover:-translate-y-1 active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Tambah Admin Baru
                </a>
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
                <div class="p-0">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse min-w-[800px]">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Identitas User</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Level Akses</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Otoritas Modul</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($users as $u)
                                <tr class="hover:bg-green-50/30 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-sekolah-green to-sekolah-green-dark flex items-center justify-center text-white font-bold text-sm shadow-sm mr-4">
                                                {{ substr($u->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-gray-800 group-hover:text-sekolah-green transition-colors">{{ $u->name }}</div>
                                                <div class="text-xs text-gray-400 font-medium">@ {{ $u->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($u->role == 'superadmin')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-700 ring-1 ring-purple-200">
                                                SUPERADMIN
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 ring-1 ring-blue-200">
                                                ADMIN
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($u->role == 'superadmin')
                                            <div class="flex items-center text-xs text-gray-400 italic">
                                                Akses Tak Terbatas
                                            </div>
                                        @else
                                            <div class="flex flex-wrap gap-1.5 max-w-[250px]">
                                                @forelse($u->moduls as $m)
                                                    <span class="inline-block bg-white text-sekolah-green-dark text-[10px] font-bold px-2 py-0.5 rounded-md border border-green-200 shadow-sm">
                                                        {{ $m->nama_modul }}
                                                    </span>
                                                @empty
                                                    <span class="text-xs text-red-400 font-medium italic">Belum Diberi Akses</span>
                                                @endforelse
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('user.edit', $u->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit User">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            </a>
                                            
                                            <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user ini permanent?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus User">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="bg-gray-50 px-6 py-3 border-t border-gray-100 flex items-center justify-between">
                        <p class="text-[10px] text-gray-400 font-medium italic">* Gunakan scroll horizontal jika tabel terpotong di layar HP.</p>
                        <p class="text-[10px] text-gray-400 font-bold">Total: {{ count($users) }} Admin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>