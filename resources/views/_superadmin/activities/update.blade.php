@extends('_superadmin._layout.app')

@section('title', 'Edit Kegiatan')

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
                        Edit {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.activities.doUpdate', $activity->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <!-- Judul -->
                        <div>
                            <label for="title" class="block text-sm font-medium mb-2 dark:text-white">Judul Kegiatan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" value="{{ old('title', $activity->title) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('title') border-red-500 @enderror"
                                required placeholder="Masukkan judul kegiatan">
                            @error('title')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="location" class="block text-sm font-medium mb-2 dark:text-white">Lokasi <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="location" name="location"
                                value="{{ old('location', $activity->location) }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 @error('location') border-red-500 @enderror"
                                required placeholder="Contoh: Aula Masjid Rohis">
                            @error('location')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <!-- Tanggal -->
                            <div>
                                <label for="event_date" class="block text-sm font-medium mb-2 dark:text-white">Tanggal <span
                                        class="text-red-500">*</span></label>
                                <input type="date" id="event_date" name="event_date"
                                    value="{{ old('event_date', $activity->event_date) }}"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white @error('event_date') border-red-500 @enderror"
                                    required>
                                @error('event_date')
                                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status (otomatis dari tanggal) -->
                            <div>
                                <label class="block text-sm font-medium mb-2 dark:text-white">Status</label>
                                @php
                                    $statusClasses = [
                                        'upcoming' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800',
                                        'ongoing'  => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800',
                                        'done'     => 'bg-gray-50 text-gray-600 border-gray-200 dark:bg-neutral-700 dark:text-neutral-400 dark:border-neutral-600',
                                    ];
                                    $currentClass = $statusClasses[$activity->status] ?? $statusClasses['upcoming'];
                                @endphp
                                <div class="py-3 px-4 flex items-center gap-2 border rounded-lg {{ $currentClass }} text-sm font-semibold">
                                    <span class="uppercase tracking-wider">{{ $activity->status }}</span>
                                    <span class="font-normal opacity-70 text-xs">— dihitung otomatis dari tanggal</span>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description" class="block text-sm font-medium mb-2 dark:text-white">Deskripsi <span
                                    class="text-red-500">*</span></label>
                            <x-trix-input id="description" name="description"
                                :value="old('description', $activity->description->toEditorHtml())" />
                            @error('description')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <!-- Poster -->
                        <x-admin.file-upload name="poster" id="poster" label="Poster Kegiatan" :value="$activity->poster" />
                    </div>
                </div>

                <div class="mt-8 flex justify-start gap-x-2">
                    <a navigate href="{{ route('superadmin.activities.index') }}"
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
