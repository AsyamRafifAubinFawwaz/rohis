@extends('_superadmin._layout.app')

@section('title', 'Tempat Sampah Postingan')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div class="flex items-center">
                    <a navigate href="{{ route('superadmin.posts.index') }}"
                        class="p-2 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
                        <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </a>
                    <div class="ms-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Tempat Sampah Postingan
                        </h2>
                    </div>
                </div>
            </div>

            <div class="p-6 overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead class="bg-gray-50 dark:bg-neutral-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Judul</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Dihapus Pada</th>
                            <th scope="col" class="px-6 py-3 text-end"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse($posts as $post)
                            <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $post->title }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500 dark:text-neutral-400">{{ $post->deleted_at->format('d M Y, H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                    <div class="flex justify-end gap-x-2">
                                        <form action="{{ route('superadmin.posts.restore', $post->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-teal-100 text-teal-800 hover:bg-teal-200 focus:outline-none transition-all cursor-pointer">
                                                Pulihkan
                                            </button>
                                        </form>
                                        <form action="{{ route('superadmin.posts.forceDelete', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen postingan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none transition-all cursor-pointer">
                                                Hapus Permanen
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-sm text-gray-400 dark:text-neutral-500 italic">
                                    Tempat sampah kosong.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
