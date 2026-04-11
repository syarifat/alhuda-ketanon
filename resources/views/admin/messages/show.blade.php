<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesan dari {{ $message->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg border border-gray-100">
                <div class="flex flex-col sm:flex-row justify-between border-b pb-4 mb-6 gap-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Pengirim</h3>
                        <p class="text-lg font-bold text-gray-900">{{ $message->name }}</p>
                        <p class="text-sm text-indigo-600">{{ $message->contact }}</p>
                    </div>
                    <div class="text-left sm:text-right">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Waktu Kirim</h3>
                        <p class="text-gray-900">{{ $message->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Isi Pesan</h3>
                    <div class="bg-gray-50 p-6 rounded-xl text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $message->content }}</div>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('admin.messages.index') }}" class="text-indigo-600 font-bold hover:underline">← Kembali ke Daftar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>