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
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none font-bolder"
                    href="{{ route('superadmin.posts.add') }}">
                    @include('_superadmin._layout.icons.add')
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">

                    <div class="px-2 pt-4">
                        <form id="filter-form" action="{{ route('superadmin.posts.index') }}" method="GET" navigate-form
                            class="flex flex-col md:flex-row items-end gap-x-4 gap-y-3">

                            <!-- Search -->
                            <div class="w-full md:w-80">
                                <label for="keywords"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Cari Data...
                                </label>
                                <div class="relative">
                                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                                        class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                                        placeholder="Cari Judul Postingan...">
                                    <div class="absolute inset-y-0 inset-e-0 flex items-center pointer-events-none pe-4">
                                        <svg class="shrink-0 size-4 text-gray-400 dark:text-neutral-500"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21-4.3-4.3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Dropdown -->
                            <div class="w-full md:w-48">
                                <label for="status"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="py-2.5 px-4 pe-9 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm">
                                    <option value="">Semua Status</option>
                                    @foreach ($statuses as $key => $label)
                                        <option value="{{ $key }}" {{ ($status ?? '') == $key ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori Dropdown -->
                            <div class="w-full md:w-56">
                                <label for="category_id"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Kategori
                                </label>
                                <select name="category_id" id="category_id"
                                    class="py-2.5 px-4 pe-9 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ ($category_id ?? '') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 pb-0.5">
                                <button type="submit"
                                    class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-brand-dark transition-all cursor-pointer shadow-md shadow-brand/20"
                                    title="Terapkan Filter">
                                    @include('_admin._layout.icons.search')
                                </button>
                                @if (!empty($keywords) || !empty($status) || !empty($category_id) || ($status_data ?? 'aktif') !== 'aktif')
                                    <a class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800 disabled:opacity-50 disabled:pointer-events-none focus:outline-none transition-all cursor-pointer shadow-sm"
                                        href="{{ route('superadmin.posts.index') }}" title="Reset Filter">
                                        @include('_admin._layout.icons.reset')
                                    </a>
                                @endif
                            </div>
                            <div class="w-full md:w-auto">
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Status Data
                                </label>
                                <div class="inline-flex p-0.5 bg-gray-100 rounded-xl dark:bg-neutral-800">
                                    <input type="hidden" name="status_data" id="status_data_input"
                                        value="{{ $status_data ?? '' }}">
                                    <button type="button" onclick="setStatusData('aktif')" id="status_data_aktif"
                                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? '') == 'aktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Aktif
                                    </button>
                                    <button type="button" onclick="setStatusData('nonaktif')" id="status_data_nonaktif"
                                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? '') == 'nonaktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Nonaktif
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div
                        class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700 shadow-sm">
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
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">Published</span>
                                                @elseif($d->status == 'pending')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">Pending
                                                        Review</span>
                                                @elseif($d->status == 'rejected')
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500">Rejected</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white">{{ ucfirst($d->status) }}</span>
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
                                                    <form action="{{ route('superadmin.posts.restore', $d->id) }}"
                                                        method="POST" class="inline" navigate-form>
                                                        @csrf
                                                        <button type="submit"
                                                            class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 focus:outline-none focus:bg-blue-200 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                            title="Pulihkan (Restore)">
                                                            @include('_admin._layout.icons.reset')
                                                        </button>
                                                    </form>

                                                    <!-- Permanent Delete -->
                                                    <button type="button"
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                        title="Hapus Permanen" data-hs-overlay="#delete-modal"
                                                        onclick="setDeleteData('{{ $d->id }}', '{{ $d->title }}', true)">
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
                                                        <form action="{{ route('superadmin.posts.approve', $d->id) }}"
                                                            method="POST" class="inline" navigate-form>
                                                            @csrf
                                                            <button type="submit"
                                                                class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-emerald-100 text-emerald-800 hover:bg-emerald-200 focus:outline-none focus:bg-emerald-200 disabled:opacity-50 disabled:pointer-events-none dark:text-emerald-400 dark:bg-emerald-800/30 dark:hover:bg-emerald-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                                title="Setujui (Publish)">
                                                                @include('_admin._layout.icons.check_circle')
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- Reject -->
                                                    @if ($d->status == 'pending')
                                                        <form action="{{ route('superadmin.posts.reject', $d->id) }}"
                                                            method="POST" class="inline" navigate-form>
                                                            @csrf
                                                            <button type="submit"
                                                                class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-400 dark:bg-red-800/30 dark:hover:bg-red-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                                title="Tolak">
                                                                @include('_admin._layout.icons.x_circle')
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- Draft -->
                                                    @if ($d->status == 'published')
                                                        <form action="{{ route('superadmin.posts.draft', $d->id) }}"
                                                            method="POST" class="inline" navigate-form>
                                                            @csrf
                                                            <button type="submit"
                                                                class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-amber-100 text-amber-800 hover:bg-amber-200 focus:outline-none focus:bg-amber-200 disabled:opacity-50 disabled:pointer-events-none dark:text-amber-400 dark:bg-amber-800/30 dark:hover:bg-amber-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                                title="Simpan Sebagai Draft">
                                                                @include('_admin._layout.icons.sun')
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <!-- Delete -->
                                                    <button type="button"
                                                        class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 focus:outline-none focus:bg-red-200 disabled:opacity-50 disabled:pointer-events-none dark:text-red-500 dark:bg-red-800/30 dark:hover:bg-red-800/20 cursor-pointer transition-all active:scale-95 shadow-sm"
                                                        title="Hapus (Pindahkan ke Sampah)"
                                                        data-hs-overlay="#delete-modal"
                                                        onclick="setDeleteData('{{ $d->id }}', '{{ $d->title }}', false)">
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
                        <form id="delete-form" method="POST" class="inline">
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

    <script>
        function setStatusData(value) {
            const input = document.getElementById('status_data_input');
            if (input.value === value) return; // Don't reload if same

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

            // Reliable form submission for SPA interceptors
            const form = document.getElementById('filter-form');
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.dispatchEvent(new Event('submit', {
                    cancelable: true,
                    bubbles: true
                }));
            }
        }

        function setDeleteData(id, title, isForce = false) {
            document.getElementById('delete-item-name').textContent = title;
            const form = document.getElementById('delete-form');
            const label = document.getElementById('delete-modal-label');
            const submitBtn = form.querySelector('button[type="submit"]');

            if (isForce) {
                label.textContent = 'Hapus Permanen';
                submitBtn.textContent = 'Ya, Hapus Permanen';
                submitBtn.classList.remove('bg-red-600', 'hover:bg-red-700');
                submitBtn.classList.add('bg-rose-600', 'hover:bg-rose-700');
                form.action = '{{ url('superadmin/posts/force-delete') }}/' + id;
            } else {
                label.textContent = 'Hapus Postingan';
                submitBtn.textContent = 'Ya, Pindahkan ke Sampah';
                submitBtn.classList.remove('bg-rose-600', 'hover:bg-rose-700');
                submitBtn.classList.add('bg-red-600', 'hover:bg-red-700');
                form.action = '{{ url('superadmin/posts/delete') }}/' + id;
            }
        }
    </script>
@endsection
