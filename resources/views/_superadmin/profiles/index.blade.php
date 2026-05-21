@extends('_superadmin._layout.app')

@section('title', 'Manajemen Profil Organisasi')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Kelola informasi profil, visi, misi, dan struktur organisasi
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.profiles.add') }}">
                    @include('_admin._layout.icons.add')
                    Tambah Profil
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-6 mt-4">
        <!-- Table View -->
        <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-2xl dark:border-neutral-700 shadow-sm bg-white dark:bg-neutral-800">
            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead class="bg-gray-50 dark:bg-neutral-900/50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Tipe Profil</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-start">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Konten (Cuplikan)</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-end">
                            <span class="text-xs font-bold uppercase text-gray-500 dark:text-neutral-400">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @forelse ($profiles as $profile)
                        <tr class="hover:bg-gray-50 dark:hover:bg-neutral-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-brand/10 text-brand dark:bg-brand/20 uppercase tracking-wider">
                                    {{ $profile->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 dark:text-neutral-400 line-clamp-2">
                                    {{ strip_tags($profile->content) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-end">
                                <div class="flex justify-end gap-1.5">
                                    <a navigate href="{{ route('superadmin.profiles.update', $profile->id) }}" 
                                        class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-500 transition-all active:scale-90" title="Edit">
                                        @include('_admin._layout.icons.pencil')
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center">
                                <x-admin.empty-state title="Belum Ada Profil" description="Mulai tambahkan informasi profil organisasi Rohis." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
