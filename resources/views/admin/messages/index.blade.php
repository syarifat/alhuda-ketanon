<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Pesan Masuk') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left whitespace-nowrap">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-4 font-bold text-sm">Pengirim</th>
                                <th class="p-4 font-bold text-sm">Kontak</th>
                                <th class="p-4 font-bold text-sm">Cuplikan Pesan</th>
                                <th class="p-4 font-bold text-sm text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($messages as $msg)
                                <tr class="{{ $msg->is_read ? 'bg-white' : 'bg-blue-50' }} hover:bg-gray-50 transition">
                                    <td class="p-4">
                                        <span class="font-medium text-gray-900">{{ $msg->name }}</span>
                                        @if(!$msg->is_read) <span class="ml-2 px-2 py-0.5 bg-blue-600 text-white text-[10px] rounded-full uppercase">Baru</span> @endif
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">{{ $msg->contact }}</td>
                                    <td class="p-4 text-sm text-gray-500 truncate max-w-xs">{{ $msg->content }}</td>
                                    <td class="p-4 text-center space-x-3">
                                        <a href="{{ route('admin.messages.show', $msg) }}" class="text-indigo-600 hover:underline text-sm font-bold">Baca</a>
                                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pesan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline text-sm font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">{{ $messages->links() }}</div>
        </div>
    </div>
</x-app-layout>