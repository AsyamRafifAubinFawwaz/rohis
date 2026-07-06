@extends('_superadmin._layout.app')

@section('title', 'Manajemen Akun')

@section('content')
    <div class="grid gap-3 md:flex md:justify-between md:items-center py-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800 dark:text-neutral-200 mb-1">
                Data {{ $page['title'] }}
            </h1>
            <p class="text-md text-gray-400 dark:text-neutral-400">
                Kelola akses Superadmin dan Admin
            </p>
        </div>

        <div>
            <div class="inline-flex gap-x-2">
                <a navigate
                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none font-bolder shadow-md shadow-brand/20 active:scale-95 transition-all text-center"
                    href="{{ route('superadmin.users.add') }}">
                    @include('_superadmin._layout.icons.add')
                    Tambah Akun
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <div class="px-2 pt-4">
                        <form id="filter-form" action="{{ route('superadmin.users.index') }}" method="GET" navigate-form
                            class="flex flex-col md:flex-row items-end gap-x-4 gap-y-3">

                            <!-- Search -->
                            <div class="w-full md:w-80">
                                <label for="keywords"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Cari Pengguna
                                </label>
                                <div class="relative">
                                    <input type="text" name="keywords" id="keywords" value="{{ $keywords ?? '' }}"
                                        class="py-2.5 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 shadow-sm"
                                        placeholder="Cari Nama atau Email...">
                                </div>
                            </div>

                            <!-- Role Filter -->
                            <div class="w-full md:w-48">
                                <label for="access_type"
                                    class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Peran
                                </label>
                                <select id="access_type" name="access_type"
                                    data-hs-select='{
                                        "placeholder": "Semua Peran",
                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2.5 ps-4 pe-9 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-xl text-start text-sm hover:bg-gray-50 focus:outline-hidden shadow-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-200 dark:hover:bg-neutral-800",
                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                        "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                    }'
                                    class="hidden">
                                    <option value="">Semua Peran</option>
                                    @foreach ($roles as $key => $label)
                                        <option value="{{ $key }}" {{ ($access_type ?? '') == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-2 pb-0.5">
                                <button type="submit"
                                    class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-brand-dark transition-all cursor-pointer shadow-md shadow-brand/20"
                                    title="Terapkan Filter">
                                    @include('_superadmin._layout.icons.search')
                                </button>
                                @if (!empty($keywords) || !empty($access_type) || ($status_data ?? 'aktif') !== 'aktif')
                                    <a class="size-[42px] inline-flex justify-center items-center gap-x-1 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800 disabled:opacity-50 disabled:pointer-events-none focus:outline-none transition-all cursor-pointer shadow-sm"
                                        href="{{ route('superadmin.users.index') }}" title="Reset Filter">
                                        @include('_superadmin._layout.icons.reset')
                                    </a>
                                @endif
                            </div>

                            <div class="w-full md:w-auto">
                                <label class="block text-xs font-bold uppercase text-gray-500 mb-1.5 dark:text-neutral-500">
                                    Status Data
                                </label>
                                <div class="inline-flex p-0.5 bg-gray-100 rounded-xl dark:bg-neutral-800">
                                    <input type="hidden" name="status_data" id="status_data_input"
                                        value="{{ $status_data ?? 'aktif' }}">
                                    <button type="button" onclick="setStatusData('aktif')" id="status_data_aktif"
                                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'aktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Aktif
                                    </button>
                                    <button type="button" onclick="setStatusData('nonaktif')" id="status_data_nonaktif"
                                        class="py-2 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent transition-all {{ ($status_data ?? 'aktif') == 'nonaktif' ? 'bg-brand text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 dark:text-neutral-400 dark:hover:text-neutral-300' }}">
                                        Terhapus
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="mx-0 my-4 overflow-x-auto border border-gray-200 rounded-lg dark:border-neutral-700 shadow-sm">
                        <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <thead class="bg-gray-50 dark:bg-neutral-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Nama</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Email</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Peran</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <span class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">Terdaftar</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @forelse($data as $u)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-x-3">
                                                <div class="size-8 rounded-full bg-brand-light dark:bg-brand-dark flex items-center justify-center text-brand dark:text-brand-light font-bold text-xs">
                                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                                </div>
                                                <span class="text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $u->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $u->email }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($u->access_type == \App\Constants\UserConst::SUPERADMIN)
                                                <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-800/30 dark:text-purple-400">Super Admin</span>
                                            @else
                                                <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400">Admin</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-600 dark:text-neutral-400">{{ $u->created_at->format('d M Y') }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end space-x-2">
                                            @if($u->trashed())
                                                 <button type="button"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 cursor-pointer shadow-sm transition-all active:scale-95"
                                                    title="Pulihkan Akun"
                                                    onclick="setActionData('restore', '{{ $u->id }}', '{{ $u->name }}')"
                                                    data-hs-overlay="#action-confirm-modal">
                                                    @include('_superadmin._layout.icons.reset')
                                                </button>
                                            @else
                                                <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-indigo-100 text-indigo-800 hover:bg-indigo-200 dark:text-indigo-400 dark:bg-indigo-800/30 dark:hover:bg-indigo-800/20 shadow-sm transition-all active:scale-95"
                                                    href="{{ route('superadmin.users.detail', $u->id) }}"
                                                    title="Detail Akun">
                                                    @include('_superadmin._layout.icons.view_detail')
                                                </a>
                                                <a navigate
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 hover:bg-blue-200 dark:text-blue-400 dark:bg-blue-800/30 dark:hover:bg-blue-800/20 shadow-sm transition-all active:scale-95"
                                                    href="{{ route('superadmin.users.update', $u->id) }}"
                                                    title="Edit Akun">
                                                    @include('_superadmin._layout.icons.pencil')
                                                </a>
                                                <button type="button"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-orange-100 text-orange-800 hover:bg-orange-200 dark:text-orange-400 dark:bg-orange-800/30 dark:hover:bg-orange-800/20 cursor-pointer shadow-sm transition-all active:scale-95"
                                                    title="Reset Password"
                                                    onclick="setActionData('reset', '{{ $u->id }}', '{{ $u->name }}')"
                                                    data-hs-overlay="#action-confirm-modal">
                                                    <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 0 0-9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="M3 12a9 9 0 0 0 9 9 9.75 9.75 0 0 0 6.74-2.74L21 16"/><path d="M16 16h5v5"/></svg>
                                                </button>
                                                <button type="button"
                                                    class="py-2 px-3 inline-flex justify-center items-center gap-x-2 text-xs font-medium rounded-lg border border-transparent bg-red-100 text-red-800 hover:bg-red-200 dark:bg-red-800/30 dark:text-red-400 shadow-sm transition-all active:scale-95"
                                                    onclick="setDeleteData('{{ $u->id }}', '{{ $u->name }}')"
                                                    data-hs-overlay="#delete-modal">
                                                    @include('_superadmin._layout.icons.trash')
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500 dark:text-neutral-500 text-sm">
                                            Tidak ada data pengguna ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($data->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-neutral-700">
                            {{ $data->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modals (Borrowed from posts for consistency) -->
    <div id="delete-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 sm:p-10 text-center">
                    <span class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-red-50 bg-red-100 text-red-500 dark:bg-red-700 dark:border-red-600 dark:text-red-100">
                        @include('_superadmin._layout.icons.warning_modal')
                    </span>
                    <h3 class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">Hapus Akun</h3>
                    <p class="text-gray-500 dark:text-neutral-500">
                        Apakah Anda yakin ingin menghapus akun <span id="delete-item-name" class="font-semibold"></span>?
                    </p>
                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800" data-hs-overlay="#delete-modal">Batal</button>
                        <form id="delete-form" method="POST" navigate-form>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700">Ya, Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="action-confirm-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="relative flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                <div class="p-4 sm:p-10 text-center">
                    <span id="action-confirm-icon" class="mb-4 inline-flex justify-center items-center size-14 rounded-full border-4 border-blue-50 bg-blue-100 text-blue-500 dark:bg-blue-700 dark:border-blue-600 dark:text-blue-100">
                        @include('_superadmin._layout.icons.warning_modal')
                    </span>
                    <h3 id="action-confirm-label" class="mb-2 text-xl font-bold text-gray-800 dark:text-neutral-200">Konfirmasi Aksi</h3>
                    <p id="action-confirm-desc" class="text-gray-500 dark:text-neutral-500"></p>
                    <div class="mt-6 flex justify-center gap-x-4">
                        <button type="button" class="py-2 px-3 inline-flex items-center text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:border-neutral-700 dark:text-neutral-300" data-hs-overlay="#action-confirm-modal">Batal</button>
                        <form id="action-confirm-form" method="POST" navigate-form>
                            @csrf
                            <button id="action-confirm-btn" type="submit" class="py-2 px-3 inline-flex items-center text-sm font-semibold rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark shadow-md shadow-brand/20">Lanjutkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-submit saat pilih filter dari hs-select
        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('access_type');
            if (el) {
                el.addEventListener('change', function () {
                    const form = document.getElementById('filter-form');
                    if (typeof form.requestSubmit === 'function') {
                        form.requestSubmit();
                    } else {
                        form.dispatchEvent(new Event('submit', { cancelable: true, bubbles: true }));
                    }
                });
            }
        });

        function setStatusData(value) {
            document.getElementById('status_data_input').value = value;
            document.getElementById('filter-form').requestSubmit();
        }

        window.setDeleteData = function(id, name) {
            let form = document.getElementById('delete-form');
            let nameSpan = document.getElementById('delete-item-name');

            if (!form || !document.getElementById('main-content').contains(form)) {
                const modal = document.getElementById('delete-modal') || document.querySelector('[aria-labelledby="delete-modal-title"]') || document.body;
                form = modal.querySelector('#delete-form') || form;
                nameSpan = modal.querySelector('#delete-item-name') || nameSpan;
            }

            if (nameSpan) nameSpan.textContent = name;
            if (form) form.setAttribute('action', '{{ url('superadmin/users/delete') }}/' + id);
        };

        window.setActionData = function(type, id, name) {
            let form  = document.getElementById('action-confirm-form');
            let label = document.getElementById('action-confirm-label');
            let desc  = document.getElementById('action-confirm-desc');
            let btn   = document.getElementById('action-confirm-btn');
            let icon  = document.getElementById('action-confirm-icon');

            if (!label) {
                const modal = document.querySelector('#action-confirm-modal') || document.querySelector('.hs-overlay[aria-labelledby="action-confirm-label"]');
                if (modal) {
                    form  = modal.querySelector('form');
                    label = modal.querySelector('h3');
                    desc  = modal.querySelector('p');
                    btn   = modal.querySelector('button[type="submit"]');
                    icon  = modal.querySelector('span');
                } else {
                    window.location.reload();
                    return;
                }
            }

            if (!label) return;

            if (type === 'reset') {
                label.textContent = 'Reset Password';
                desc.innerHTML = `Apakah Anda yakin ingin mereset password pengguna <strong>${name}</strong>? Password akan diubah menjadi <em>password123</em>.`;
                form.setAttribute('action', '{{ url('superadmin/users/reset-password') }}/' + id);
                btn.className = 'py-2 px-3 inline-flex items-center text-sm font-semibold rounded-lg bg-orange-600 text-white hover:bg-orange-700 shadow-orange-500/20 shadow-md';
                btn.textContent = 'Ya, Reset Password';
            } else if (type === 'restore') {
                label.textContent = 'Pulihkan Akun';
                desc.innerHTML = `Pulihkan kembali akun <strong>${name}</strong> agar dapat digunakan kembali?`;
                form.setAttribute('action', '{{ url('superadmin/users/restore') }}/' + id); // Note: Need restore method in controller if using soft delete restore
                btn.className = 'py-2 px-3 inline-flex items-center text-sm font-semibold rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 shadow-emerald-500/20 shadow-md';
                btn.textContent = 'Ya, Pulihkan';
            }
        }
    </script>
@endsection
