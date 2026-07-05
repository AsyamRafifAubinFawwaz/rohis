@extends('_superadmin._layout.app')

@section('title', 'Edit Pengurus')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div
            class="bg-white shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a navigate href="{{ route('superadmin.organizer.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Edit {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.organizer.doUpdate', $organizer->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2 dark:text-white">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $organizer->name) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('name') border-red-500 focus:border-red-500 @enderror"
                                required placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-medium mb-2 dark:text-white">Jabatan <span
                                    class="text-red-500">*</span></label>
                            <select id="jabatan" name="jabatan"
                                data-hs-select='{
                                    "hasSearch": true,
                                    "searchPlaceholder": "Cari jabatan...",
                                    "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                                    "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                                    "placeholder": "Pilih jabatan...",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-lg text-start text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                    "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }'
                                class="hidden @error('jabatan') border-red-500 @enderror"
                                required>
                                @foreach ($jabatanList as $jabatan)
                                    <option value="{{ $jabatan }}"
                                        {{ old('jabatan', $organizer->jabatan) === $jabatan ? 'selected' : '' }}>
                                        {{ $jabatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jabatan')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Periode -->
                        <div>
                            <label for="periode" class="block text-sm font-medium mb-2 dark:text-white">Periode <span
                                    class="text-red-500">*</span></label>
                            <select id="periode" name="periode"
                                data-hs-select='{
                                    "hasSearch": true,
                                    "searchPlaceholder": "Cari periode...",
                                    "searchWrapperClasses": "bg-white p-2 -mx-1 sticky top-0 dark:bg-neutral-900",
                                    "searchClasses": "block w-full text-sm border-gray-200 rounded-lg focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400",
                                    "placeholder": "Pilih periode...",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 px-4 flex gap-x-2 flex-wrap text-nowrap w-full cursor-pointer bg-white border border-gray-200 text-gray-800 rounded-lg text-start text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600",
                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:bg-neutral-900 dark:border-neutral-700 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500",
                                    "optionClasses": "hs-selected:bg-brand/10 dark:hs-selected:bg-brand/20 py-2 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-800 rounded-lg focus:outline-hidden",
                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-brand\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-400 dark:text-neutral-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }'
                                class="hidden @error('periode') border-red-500 @enderror"
                                required>
                                <option value="" disabled>Pilih periode...</option>
                                @foreach ($periodeOptions as $option)
                                    <option value="{{ $option['value'] }}"
                                        {{ old('periode', $organizer->periode) === $option['value'] ? 'selected' : '' }}>
                                        {{ $option['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('periode')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Foto -->
                        <x-admin.file-upload name="image" id="image" label="Foto Pengurus"
                            :preview="$organizer->image ? asset('storage/' . $organizer->image) : null" />
                    </div>
                </div>

                <div class="mt-8 flex justify-start gap-x-2">
                    <a navigate href="{{ route('superadmin.organizer.index') }}"
                        class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none transition-all active:scale-95 shadow-md shadow-brand/20 cursor-pointer">
                        @include('_admin._layout.icons.pencil')
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
