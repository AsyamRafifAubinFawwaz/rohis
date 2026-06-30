@extends('_superadmin._layout.app')

@section('title', 'Tambah Kegiatan')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a navigate href="{{ route('superadmin.activities.index') }}"
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
                        Tambah {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.activities.create') }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Judul Kegiatan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('title') border-red-500 focus:border-red-500 @enderror"
                                required placeholder="Masukkan judul kegiatan">
                            @error('title')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="location" class="block text-sm font-medium mb-2 dark:text-white">Lokasi <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 @error('location') border-red-500 @enderror"
                                required placeholder="Contoh: Aula Masjid Rohis">
                            @error('location')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3">
                            <label class="block text-sm font-medium dark:text-white">
                                Tanggal & Waktu Kegiatan <span class="text-red-500">*</span>
                            </label>

                            {{-- Date Range --}}
                            <div class="flex items-center gap-2">
                                {{-- Start Date --}}
                                <div class="relative flex-1">
                                    <input type="text" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                        class="datepicker px-4 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('start_date') border-red-500 @enderror"
                                        required placeholder="Pilih Tanggal">
                                </div>

                                <span class="text-gray-400 dark:text-neutral-500 font-medium text-sm shrink-0">—</span>

                                {{-- End Date --}}
                                <div class="relative flex-1">
                                    <input type="text" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                        class="datepicker px-4 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('end_date') border-red-500 @enderror"
                                        required placeholder="Pilih Tanggal">
                                </div>
                            </div>

                            {{-- Time Range --}}
                            <div class="flex items-center gap-2">
                                {{-- Start Time --}}
                                <div class="relative flex-1">
                                    <input type="text" id="start_time" name="start_time" value="{{ old('start_time', '08:00') }}"
                                        class="timepicker px-4 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('start_time') border-red-500 @enderror"
                                        required placeholder="Pilih Waktu">
                                </div>

                                <span class="text-gray-400 dark:text-neutral-500 font-medium text-sm shrink-0">—</span>

                                {{-- End Time --}}
                                <div class="relative flex-1">
                                    <input type="text" id="end_time" name="end_time" value="{{ old('end_time', '17:00') }}"
                                        class="timepicker px-4 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('end_time') border-red-500 @enderror"
                                        required placeholder="Pilih Waktu">
                                </div>
                            </div>

                            @error('start_date') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('start_time') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('end_date') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('end_time') <p class="text-xs text-red-600">{{ $message }}</p> @enderror

                            <p class="text-xs text-gray-400 dark:text-neutral-500">
                                Status akan otomatis berubah: <span class="font-medium text-blue-500">Upcoming</span> → <span class="font-medium text-emerald-500">Ongoing</span> → <span class="font-medium text-gray-500">Done</span>
                            </p>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi <span
                                    class="text-red-500">*</span></label>
                            <x-trix-input id="description" name="description" :value="old('description')" />
                            @error('description')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Poster -->
                        <x-admin.file-upload name="poster" id="poster" label="Poster Kegiatan" />
                    </div>
                </div>

                <div class="mt-8 flex justify-start gap-x-2">
                    <a navigate href="{{ route('superadmin.activities.index') }}"
                        class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 transition-all">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none transition-all active:scale-95 shadow-md shadow-brand/20 cursor-pointer">
                        @include('_admin._layout.icons.add')
                        Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
