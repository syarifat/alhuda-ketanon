<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Berita') }}
            </h2>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                + Tambah Berita
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="border-b-2 border-gray-200 bg-gray-50 text-sm uppercase text-gray-600">
                                    <th class="p-4 font-semibold text-center w-16">No</th>
                                    <th class="p-4 font-semibold">Judul Berita</th>
                                    <th class="p-4 font-semibold text-center hidden sm:table-cell">Status</th>
                                    <th class="p-4 font-semibold text-center hidden md:table-cell">Views</th>
                                    <th class="p-4 font-semibold text-center hidden lg:table-cell">Tanggal</th>
                                    <th class="p-4 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($articles as $index => $article)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="p-4 text-center text-gray-500">{{ $articles->firstItem() + $index }}</td>
                                        <td class="p-4">
                                            <p class="font-medium text-gray-900 truncate max-w-xs md:max-w-md">{{ $article->title }}</p>
                                            <p class="text-xs mt-1 sm:hidden">
                                                <span class="{{ $article->is_published ? 'text-green-600' : 'text-yellow-600' }}">
                                                    {{ $article->is_published ? 'Published' : 'Draft' }}
                                                </span>
                                            </p>
                                        </td>
                                        <td class="p-4 text-center hidden sm:table-cell">
                                            @if($article->is_published)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Published
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-center text-gray-500 hidden md:table-cell">{{ $article->views }}</td>
                                        <td class="p-4 text-center text-gray-500 hidden lg:table-cell">{{ $article->created_at->format('d M Y') }}</td>
                                        <td class="p-4 text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="{{ route('admin.articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Edit</a>
                                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-sm">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-gray-500 bg-gray-50 rounded-lg border-dashed border-2 mt-4">
                                            Belum ada berita yang diterbitkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>