<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h2 class="font-black text-green-900 text-xl">Kelola Users</h2>
            <a href="{{ route('admin.users.create') }}" class="admin-btn-primary">+ Tambah User</a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl text-sm font-medium flex items-center gap-2">
            <span>✓</span> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-600 rounded-2xl text-sm font-medium flex items-center gap-2">
            <span>✕</span> {{ session('error') }}
        </div>
    @endif

    <div class="admin-card overflow-hidden p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-green-100 bg-green-50/60">
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center w-12">No</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider">Pengguna</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider hidden sm:table-cell">Username</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider hidden md:table-cell">Email</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center hidden lg:table-cell">Terdaftar</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-50">
                    @forelse($users as $i => $user)
                        <tr class="hover:bg-green-50/40 transition-colors {{ $user->id === auth()->id() ? 'bg-green-50/30' : '' }}">
                            <td class="px-5 py-4 text-center text-sm text-gray-400">{{ $users->firstItem() + $i }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0 shadow-sm">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm flex items-center gap-1.5">
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                                <span class="text-xs font-bold bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Anda</span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-400 md:hidden">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-500 hidden sm:table-cell font-mono">{{ $user->username ?? '-' }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500 hidden md:table-cell">{{ $user->email }}</td>
                            <td class="px-5 py-4 text-center text-xs text-gray-400 hidden lg:table-cell">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-full transition-all">
                                        ✎ Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user {{ addslashes($user->name) }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-full transition-all">
                                                🗑 Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-16 text-center text-gray-400">
                                <div class="text-4xl mb-3">👤</div>
                                <p class="font-semibold">Belum ada user terdaftar.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="px-5 py-4 border-t border-green-50">{{ $users->links() }}</div>
        @endif
    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:16px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
        .admin-btn-primary { background:linear-gradient(135deg,#16a34a,#22c55e); color:#fff; font-size:0.8rem; font-weight:800; padding:9px 20px; border-radius:9999px; box-shadow:0 2px 10px rgba(22,163,74,0.35); transition:all 0.2s; display:inline-block; }
        .admin-btn-primary:hover { box-shadow:0 4px 16px rgba(22,163,74,0.5); transform:translateY(-1px); }
    </style>
</x-app-layout>
