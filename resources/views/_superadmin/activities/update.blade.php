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

                        <div class="space-y-3">
                            <label class="block text-sm font-medium dark:text-white">
                                Tanggal & Waktu Kegiatan <span class="text-red-500">*</span>
                            </label>

                            {{-- Date Range --}}
                            <div class="flex items-center gap-2">
                                {{-- Start Date --}}
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400 dark:text-neutral-500">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                                    </div>
                                    <input type="date" id="start_date" name="start_date"
                                        value="{{ old('start_date', $activity->event_start?->format('Y-m-d')) }}"
                                        class="ps-10 pe-3 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('start_date') border-red-500 @enderror"
                                        required>
                                </div>

                                <span class="text-gray-400 dark:text-neutral-500 font-medium text-sm shrink-0">—</span>

                                {{-- End Date --}}
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400 dark:text-neutral-500">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/></svg>
                                    </div>
                                    <input type="date" id="end_date" name="end_date"
                                        value="{{ old('end_date', $activity->event_end?->format('Y-m-d')) }}"
                                        class="ps-10 pe-3 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('end_date') border-red-500 @enderror"
                                        required>
                                </div>
                            </div>

                            {{-- Time Range --}}
                            <div class="flex items-center gap-2">
                                {{-- Start Time --}}
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none text-gray-400 dark:text-neutral-500">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    </div>
                                    <input type="time" id="start_time" name="start_time"
                                        value="{{ old('start_time', $activity->event_start?->format('H:i') ?? '08:00') }}"
                                        class="pe-10 ps-3 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('start_time') border-red-500 @enderror"
                                        required>
                                </div>

                                <span class="text-gray-400 dark:text-neutral-500 font-medium text-sm shrink-0">—</span>

                                {{-- End Time --}}
                                <div class="relative flex-1">
                                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5 pointer-events-none text-gray-400 dark:text-neutral-500">
                                        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    </div>
                                    <input type="time" id="end_time" name="end_time"
                                        value="{{ old('end_time', $activity->event_end?->format('H:i') ?? '17:00') }}"
                                        class="pe-10 ps-3 py-2.5 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:focus:ring-neutral-600 shadow-sm @error('end_time') border-red-500 @enderror"
                                        required>
                                </div>
                            </div>

                            @error('start_date') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('start_time') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('end_date') <p class="text-xs text-red-600">{{ $message }}</p> @enderror
                            @error('end_time') <p class="text-xs text-red-600">{{ $message }}</p> @enderror

                            {{-- Status Badge --}}
                            @php
                                $statusClasses = [
                                    'upcoming' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/20 dark:text-blue-400 dark:border-blue-800',
                                    'ongoing'  => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-900/20 dark:text-emerald-400 dark:border-emerald-800',
                                    'done'     => 'bg-gray-50 text-gray-600 border-gray-200 dark:bg-neutral-700 dark:text-neutral-400 dark:border-neutral-600',
                                ];
                                $currentClass = $statusClasses[$activity->status] ?? $statusClasses['upcoming'];
                            @endphp
                            <div class="py-2.5 px-4 flex items-center gap-2 border rounded-xl {{ $currentClass }} text-sm font-semibold">
                                <span class="uppercase tracking-wider text-xs">{{ $activity->status }}</span>
                                <span class="font-normal opacity-70 text-xs">— dihitung otomatis dari waktu mulai & selesai</span>
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
