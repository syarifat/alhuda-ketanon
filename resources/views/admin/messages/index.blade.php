<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-green-900 text-xl">Pesan Masuk</h2>
    </x-slot>

    <div class="admin-card overflow-hidden p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-green-100 bg-green-50/60">
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider">Pengirim</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider hidden sm:table-cell">Kontak</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider">Cuplikan Pesan</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center hidden md:table-cell">Waktu</th>
                        <th class="px-5 py-3.5 text-xs font-black text-green-700 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-50">
                    @foreach ($messages as $msg)
                        <tr class="{{ $msg->is_read ? '' : 'bg-green-50/60' }} hover:bg-green-50/40 transition-colors">
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                                        {{ strtoupper(substr($msg->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm flex items-center gap-1.5">
                                            {{ $msg->name }}
                                            @if(!$msg->is_read)
                                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span>
                                            @endif
                                        </p>
                                        <p class="text-xs text-gray-400 sm:hidden">{{ $msg->contact }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-sm text-gray-500 hidden sm:table-cell">{{ $msg->contact }}</td>
                            <td class="px-5 py-4 text-sm text-gray-500 truncate max-w-[200px]">{{ $msg->content }}</td>
                            <td class="px-5 py-4 text-center text-xs text-gray-400 hidden md:table-cell">{{ $msg->created_at->diffForHumans() }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.messages.show', $msg) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-green-700 bg-green-100 hover:bg-green-200 px-3 py-1.5 rounded-full transition-all">
                                        👁 Baca
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-full transition-all">
                                            🗑 Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div class="px-5 py-4 border-t border-green-50">{{ $messages->links() }}</div>
        @endif
    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:16px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
    </style>
</x-app-layout>