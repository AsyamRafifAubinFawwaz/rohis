@extends('_superadmin._layout.app')

@section('title', 'Manajemen Postingan')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Artikel Rohis
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.posts.add') }}">
                    @include('_superadmin._layout.icons.add')
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        
        <!-- Filter Form -->
        <div class="pt-4 mb-2">
                        <form id="filter-form" action="{{ route('superadmin.posts.index') }}" method="GET" navigate-form
                            class="grid grid-cols-2 md:flex md:flex-row md:items-end gap-3">

                            <!-- Search (full width on mobile, fixed on desktop) -->
                            <div class="col-span-2 md:col-span-1 md:w-80">
                                <label for="keywords"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Cari Data...
                                </label>
                                <div class="relative">
                                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                                        class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                                        placeholder="Cari Judul Postingan...">
                                  
                                </div>
                            </div>

                            <!-- Status Dropdown -->
                            <div class="md:w-48">
                                <label for="status"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Status
                                </label>
                                <select id="status" name="status"
                                    data-hs-select='{
                                        "placeholder": "Semua Status",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-xl text-start text-sm hover:bg-gray-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                        "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }'
                                    class="hidden">
                                    <option value="">Semua Status</option>
                                    @foreach ($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ ($status ?? '') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori Dropdown -->
                            <div class="md:w-56">
                                <label for="category_id"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Kategori
                                </label>
                                <select id="category_id" name="category_id"
                                    data-hs-select='{
                                        "placeholder": "Semua Kategori",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-xl text-start text-sm hover:bg-gray-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                        "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }'
                                    class="hidden">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ ($category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status Data -->
                            <div class="md:w-auto">
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Status Data
                                </label>
                                <div class="inline-flex p-0.5 bg-gray-100 rounded-xl dark:bg-neutral-800">
                                    <input type="hidden" name="status_data" id="status_data_input"
                                        value="{{ $status_data ?? '' }}">
                                    <button type="button" onclick="setStatusData('aktif')" id="status_data_aktif"
                                        class="py-2 px-4 sm:px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? '') == 'aktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Aktif
                                    </button>
                                    <button type="button" onclick="setStatusData('nonaktif')" id="status_data_nonaktif"
                                        class="py-2 px-4 sm:px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? '') == 'nonaktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Nonaktif
                                    </button>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end gap-2 md:w-auto">
                                <button type="submit"
                                    class="py-2.5 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-brand-dark transition-all cursor-pointer shadow-md shadow-brand/20"
                                    title="Terapkan Filter">
                                    @include('_admin._layout.icons.search')
                                    Cari
                                </button>
                                @if (!empty($keywords) || !empty($status) || !empty($category_id) || ($status_data ?? 'aktif') !== 'aktif')
                                    <a class="py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800 disabled:opacity-50 disabled:pointer-events-none focus:outline-none transition-all cursor-pointer shadow-sm"
                                        href="{{ route('superadmin.posts.index') }}" title="Reset Filter">
                                        @include('_admin._layout.icons.reset')
                                    </a>
                                @endif
                            </div>

                        </form>

                    </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                    
                    <!-- Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Judul
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Penulis
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Kategori
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Status
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">
                                            Tanggal
                                        </span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($data as $d)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors">
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $d->title }}</span>
                                                <span
                                                    class="block text-xs text-gray-500 dark:text-neutral-500">{{ $d->slug }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ $d->user->name ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <div class="flex flex-wrap gap-1">
                                                    @forelse($d->categories as $cat)
                                                        <span
                                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-300">
                                                            {{ $cat->name }}
                                                        </span>
                                                    @empty
                                                        <span class="text-xs text-gray-400 dark:text-neutral-500">-</span>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                @if ($d->status == 'published')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-400">Published</span>
                                                @elseif($d->status == 'pending')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-400">Pending
                                                        Review</span>
                                                @elseif($d->status == 'rejected')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-400">Rejected</span>
                                                @elseif($d->status == 'draft')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-400">Draft</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-600 dark:bg-neutral-700 dark:text-neutral-400">{{ ucfirst($d->status) }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-3">
                                                <span
                                                    class="block text-sm text-gray-800 dark:text-neutral-200">{{ $d->created_at->format('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td class="size-px whitespace-nowrap">
                                            <div class="px-6 py-1.5 flex items-center gap-x-2 justify-end">
                                                <!-- Action buttons (Consistent with Category style) -->
                                                @if ($d->trashed())
                                                    <!-- Restore -->
                                                    <button type="button"
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                        title="Pulihkan (Restore)"
                                                        data-hs-overlay="#action-confirm-modal"
                                                        onclick="setActionData('restore', '{{ $d->id }}', '{{ addslashes($d->title) }}')"
                                                    >
                                                        @include('_admin._layout.icons.reset')
                                                    </button>

                                                    <!-- Permanent Delete -->
                                                    <button type="button"
                                                        class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all active:scale-90 dark:bg-rose-900/30 dark:text-rose-600 dark:hover:bg-rose-100"
                                                        title="Hapus Permanen"
                                                        data-hs-overlay="#delete-modal"
                                                        onclick="setDeleteData('{{ $d->id }}', '{{ addslashes($d->title) }}', true)">
                                                        @include('_admin._layout.icons.trash')
                                                    </button>
                                                @else
                                                    <!-- Detail -->
                                                    <a navigate
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 focus:outline-none focus:bg-indigo-200 disabled:opacity-50 disabled:pointer-events-none dark:text-indigo-400 dark:bg-indigo-800/30 dark:hover:bg-indigo-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                        href="{{ route('superadmin.posts.detail', $d->id) }}"
                                                        title="Lihat Detail">
                                                        @include('_admin._layout.icons.view_detail')
                                                    </a>

                                                    <!-- Edit -->
                                                    <a navigate
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                        href="{{ route('superadmin.posts.update', $d->id) }}"
                                                        title="Edit Postingan">
                                                        @include('_admin._layout.icons.pencil')
                                                    </a>

                                                    <!-- Approve -->
                                                    @if ($d->status != 'published')
                                                        <button type="button"
                                                            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-emerald-100 text-emerald-800 hover:bg-emerald-200 focus:outline-none focus:bg-emerald-200 disabled:opacity-50 disabled:pointer-events-none dark:text-emerald-400 dark:bg-emerald-800/30 dark:hover:bg-emerald-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                            title="Setujui (Publish)"
                                                            data-hs-overlay="#action-confirm-modal"
                                                            onclick="setActionData('approve', '{{ $d->id }}', '{{ addslashes($d->title) }}')"
                                                        >
                                                            @include('_admin._layout.icons.check_circle')
                                                        </button>
                                                    @endif

                                                    <!-- Reject -->
                                                    @if ($d->status == 'pending')
                                                        <button type="button"
                                                            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-400 dark:bg-red-800/30 dark:hover:bg-red-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                            title="Tolak"
                                                            data-hs-overlay="#action-confirm-modal"
                                                            onclick="setActionData('reject', '{{ $d->id }}', '{{ addslashes($d->title) }}')"
                                                        >
                                                            @include('_admin._layout.icons.x_circle')
                                                        </button>
                                                    @endif

                                                    <!-- Draft -->
                                                    @if ($d->status == 'published')
                                                        <button type="button"
                                                            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-amber-100 text-amber-800 hover:bg-amber-200 focus:outline-none focus:bg-amber-200 disabled:opacity-50 disabled:pointer-events-none dark:text-amber-400 dark:bg-amber-800/30 dark:hover:bg-amber-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                            title="Simpan Sebagai Draft"
                                                            data-hs-overlay="#action-confirm-modal"
                                                            onclick="setActionData('draft', '{{ $d->id }}', '{{ addslashes($d->title) }}')"
                                                        >
                                                            @include('_admin._layout.icons.sun')
                                                        </button>
                                                    @endif

                                                    <!-- Delete -->
                                                    <button type="button"
                                                        class="p-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all active:scale-90 dark:bg-red-900/30 dark:text-red-600 dark:hover:bg-red-100"
                                                        data-hs-overlay="#delete-modal"
                                                        onclick="setDeleteData('{{ $d->id }}', '{{ addslashes($d->title) }}', false)">
                                                        @include('_admin._layout.icons.trash')
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-6 py-4 text-center text-sm text-gray-500 dark:text-neutral-500">
                                            <x-admin.empty-state />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (count($data) > 0 && $data->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                            <div class="flex justify-end">
                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1" aria-labelledby="delete-modal-label">
        <div
            class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div
                class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="absolute top-2 end-2">
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#delete-modal">
                        <span class="sr-only">Close</span>
                        @include('_admin._layout.icons.close_modal')
                    </button>
                </div>

                <div class="p-4 sm:p-10 text-center overflow-y-auto">
                    <!-- Icon -->
                    <span
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>
                    <!-- End Icon -->

                    <h3 id="delete-modal-label" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Hapus Postingan
                    </h3>
                    <p class="text-gray-500 dark:text-neutral-500">
                        Apakah Anda yakin ingin menghapus postingan <span id="delete-item-name"
                            class="font-semibold text-gray-800 dark:text-neutral-200"></span>?
                        <br>Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            data-hs-overlay="#delete-modal">
                            Batal
                        </button>
                        <form id="delete-form" method="POST" class="inline" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Confirmation Modal -->
    <div id="action-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto"
        role="dialog" tabindex="-1" aria-labelledby="action-confirm-label">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="absolute top-2 end-2">
                    <button type="button"
                        class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                        aria-label="Close" data-hs-overlay="#action-confirm-modal">
                        <span class="sr-only">Close</span>
                        @include('_admin._layout.icons.close_modal')
                    </button>
                </div>

                <div class="p-4 sm:p-10 text-center overflow-y-auto">
                    <span id="action-confirm-icon"
                        class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-blue-50 bg-blue-100 text-blue-500 dark:bg-blue-700 dark:border-blue-600 dark:text-blue-100">
                        @include('_admin._layout.icons.warning_modal')
                    </span>

                    <h3 id="action-confirm-label" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Konfirmasi Aksi
                    </h3>
                    <p id="action-confirm-desc" class="text-gray-500 dark:text-neutral-500"></p>

                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800"
                            data-hs-overlay="#action-confirm-modal">
                            Batal
                        </button>
                        <form id="action-confirm-form" method="POST" class="inline" navigate-form>
                            @csrf
                            <button id="action-confirm-btn" type="submit"
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none disabled:opacity-50 disabled:pointer-events-none cursor-pointer transition-all active:scale-95 shadow-md shadow-brand/20">
                                Ya, Lanjutkan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit saat pilih filter dari hs-select
        document.addEventListener('DOMContentLoaded', function () {
            ['status', 'category_id'].forEach(function (id) {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('change', function () {
                        document.getElementById('filter-form').submit();
                    });
                }
            });
        });

        function setStatusData(value) {
            const input = document.getElementById('status_data_input');
            if (input.value === value) return;

            input.value = value;
            const aktifBtn = document.getElementById('status_data_aktif');
            const nonaktifBtn = document.getElementById('status_data_nonaktif');

            if (value === 'aktif') {
                aktifBtn.classList.add('bg-brand', 'text-white', 'shadow-sm');
                aktifBtn.classList.remove('text-gray-500', 'dark:text-neutral-400');
                nonaktifBtn.classList.remove('bg-brand', 'text-white', 'shadow-sm');
                nonaktifBtn.classList.add('text-gray-500', 'dark:text-neutral-400');
            } else {
                nonaktifBtn.classList.add('bg-brand', 'text-white', 'shadow-sm');
                nonaktifBtn.classList.remove('text-gray-500', 'dark:text-neutral-400');
                aktifBtn.classList.remove('bg-brand', 'text-white', 'shadow-sm');
                aktifBtn.classList.add('text-gray-500', 'dark:text-neutral-400');
            }

            const form = document.getElementById('filter-form');
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
            }
        }

        window.setDeleteData = function(id, name, isPermanent = false) {
            let form = document.getElementById('delete-form');
            let nameSpan = document.getElementById('delete-item-name');
            let title = document.getElementById('delete-modal-title');
            let alertText = document.getElementById('delete-alert-text');
            let submitBtn = document.getElementById('delete-submit-btn');

            if (!form || !document.body.contains(form)) {
                const modal = document.getElementById('delete-modal') || document.querySelector('[aria-labelledby="delete-modal-title"]') || document.body;
                form = modal.querySelector('#delete-form') || form;
                nameSpan = modal.querySelector('#delete-item-name') || nameSpan;
                title = modal.querySelector('#delete-modal-title') || title;
                alertText = modal.querySelector('#delete-alert-text') || alertText;
                submitBtn = modal.querySelector('#delete-submit-btn') || submitBtn;
            }

            if (nameSpan) nameSpan.textContent = name;

            if (isPermanent) {
                if (title) title.textContent = 'Hapus Permanen Postingan';
                if (alertText) alertText.textContent = 'Postingan akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.';
                if (submitBtn) {
                    submitBtn.textContent = 'Ya, Hapus Permanen';
                    submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
                    submitBtn.classList.add('bg-rose-600', 'hover:bg-rose-700');
                }
                if (form) form.setAttribute('action', '{{ url('superadmin/posts/force-delete') }}/' + id);
            } else {
                if (title) title.textContent = 'Hapus Postingan';
                if (alertText) alertText.textContent = 'Apakah Anda yakin ingin menghapus postingan ' + name + '? Tindakan ini tidak dapat dibatalkan.';
                if (submitBtn) {
                    submitBtn.textContent = 'Ya, Hapus Postingan';
                    submitBtn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                    submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                }
                if (form) form.setAttribute('action', '{{ url('superadmin/posts/delete') }}/' + id);
            }
        };

        window.setActionData = function(type, id, title) {
            // Coba cari elemen di seluruh dokumen
            let form  = document.getElementById('action-confirm-form');
            let label = document.getElementById('action-confirm-label');
            let desc  = document.getElementById('action-confirm-desc');
            let btn   = document.getElementById('action-confirm-btn');
            let icon  = document.getElementById('action-confirm-icon');

            // Fallback: Jika tidak ditemukan by ID, mungkin ada bug SPA/Preline, cari berdasarkan query selector fallback
            if (!label) {
                console.warn("action-confirm-label tidak ditemukan by ID! Mencari via selector fallback...");
                const modal = document.querySelector('#action-confirm-modal') || document.querySelector('.hs-overlay[aria-labelledby="action-confirm-label"]');
                if (modal) {
                    form  = modal.querySelector('form');
                    label = modal.querySelector('h3');
                    desc  = modal.querySelector('p');
                    btn   = modal.querySelector('button[type="submit"]');
                    icon  = modal.querySelector('span');
                } else {
                    console.error("CRITICAL: action-confirm-modal benar-benar hilang dari DOM!");
                    // Force reload as last resort
                    window.location.reload();
                    return;
                }
            }

            if (!label) {
                console.error("Gagal menemukan elemen modal yang dibutuhkan!");
                return;
            }

            const configs = {
                approve: {
                    label  : 'Setujui & Publish',
                    desc   : `Apakah Anda yakin ingin mem-publish postingan <strong class="text-gray-800 dark:text-neutral-200">${title}</strong>? Postingan akan langsung tampil ke publik.`,
                    btnText: 'Ya, Publish',
                    btnClass: ['bg-emerald-600', 'hover:bg-emerald-700', 'shadow-emerald-500/20'],
                    iconClass: ['border-emerald-50', 'bg-emerald-100', 'text-emerald-500', 'dark:bg-emerald-700', 'dark:border-emerald-600', 'dark:text-emerald-100'],
                    url    : '{{ url('superadmin/posts/approve') }}/' + id,
                },
                reject: {
                    label  : 'Tolak Postingan',
                    desc   : `Apakah Anda yakin ingin menolak postingan <strong class="text-gray-800 dark:text-neutral-200">${title}</strong>?`,
                    btnText: 'Ya, Tolak',
                    btnClass: ['bg-red-600', 'hover:bg-red-700', 'shadow-red-500/20'],
                    iconClass: ['border-red-50', 'bg-red-100', 'text-red-500', 'dark:bg-red-700', 'dark:border-red-600', 'dark:text-red-100'],
                    url    : '{{ url('superadmin/posts/reject') }}/' + id,
                },
                draft: {
                    label  : 'Simpan sebagai Draft',
                    desc   : `Postingan <strong class="text-gray-800 dark:text-neutral-200">${title}</strong> akan ditarik dari publik dan disimpan sebagai draft.`,
                    btnText: 'Ya, Jadikan Draft',
                    btnClass: ['bg-amber-500', 'hover:bg-amber-600', 'shadow-amber-500/20'],
                    iconClass: ['border-amber-50', 'bg-amber-100', 'text-amber-500', 'dark:bg-amber-700', 'dark:border-amber-600', 'dark:text-amber-100'],
                    url    : '{{ url('superadmin/posts/draft') }}/' + id,
                },
                restore: {
                    label  : 'Pulihkan Postingan',
                    desc   : `Postingan <strong class="text-gray-800 dark:text-neutral-200">${title}</strong> akan dipulihkan dari sampah dengan status <em>draft</em>.`,
                    btnText: 'Ya, Pulihkan',
                    btnClass: ['bg-blue-600', 'hover:bg-blue-700', 'shadow-blue-500/20'],
                    iconClass: ['border-blue-50', 'bg-blue-100', 'text-blue-500', 'dark:bg-blue-700', 'dark:border-blue-600', 'dark:text-blue-100'],
                    url    : '{{ url('superadmin/posts/restore') }}/' + id,
                },
            };

            const cfg = configs[type];
            if (!cfg) { return; }

            label.textContent    = cfg.label;
            desc.innerHTML       = cfg.desc;
            btn.textContent      = cfg.btnText;
            form.setAttribute('action', cfg.url);

            // Reset & apply button classes
            btn.className = 'py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none cursor-pointer transition-all active:scale-95 shadow-md ' + cfg.btnClass.join(' ');

            // Reset & apply icon classes
            icon.className = 'mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 ' + cfg.iconClass.join(' ');
        }
    </script>
@endsection
