<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.messages.index') }}" class="w-8 h-8 rounded-full bg-green-100 hover:bg-green-200 flex items-center justify-center text-green-700 text-sm transition-all">←</a>
            <h2 class="font-black text-green-900 text-xl">Pesan dari {{ $message->name }}</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <div class="admin-card">
            <!-- Sender info -->
            <div class="flex items-center gap-4 pb-5 mb-5 border-b border-green-100">
                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-black text-xl shadow-md flex-shrink-0">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <p class="font-black text-green-900 text-lg">{{ $message->name }}</p>
                    <p class="text-sm text-green-600">{{ $message->contact }}</p>
                </div>
                <div class="text-right text-xs text-gray-400">
                    <p>{{ $message->created_at->format('d F Y') }}</p>
                    <p>{{ $message->created_at->format('H:i') }} WIB</p>
                </div>
            </div>

            <!-- Message body -->
            <div class="mb-6">
                <p class="text-xs font-black text-green-700 uppercase tracking-widest mb-3">Isi Pesan</p>
                <div class="bg-green-50 border border-green-100 rounded-2xl p-5 text-gray-700 leading-relaxed whitespace-pre-wrap text-sm">{{ $message->content }}</div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-green-100">
                <a href="{{ route('admin.messages.index') }}" class="text-sm font-bold text-green-700 hover:text-green-900 transition-colors flex items-center gap-1.5">
                    ← Kembali ke Daftar
                </a>
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 bg-red-50 hover:bg-red-100 px-4 py-2 rounded-full transition-all">
                        🗑 Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .admin-card { background:#fff; border:1px solid #dcfce7; border-radius:20px; padding:28px; box-shadow:0 2px 12px rgba(5,46,22,0.05); }
    </style>
</x-app-layout>