@extends('_superadmin._layout.app')

@section('title', 'Tambah Profil Organisasi')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a href="{{ route('superadmin.profiles.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 19-7-7 7-7" />
                        <path d="M19 12H5" />
                    </svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        {{ $page['title'] }}
                    </h2>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.profiles.create') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <!-- Form Group -->
                    <div>
                        <label for="type" class="block text-sm font-medium mb-2 dark:text-white">Tipe Profil <span class="text-red-500">*</span></label>
                        <select id="type" name="type" 
                            class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-brand focus:ring-brand disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('type') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                            required>
                            <option value="" disabled selected>Pilih Tipe...</option>
                            @foreach ($availableTypes as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ strtoupper($type) }}</option>
                            @endforeach
                        </select>
                        @if(empty($availableTypes))
                            <p class="text-xs text-amber-600 mt-2 italic">Semua tipe profil sudah terisi. Silakan edit data yang sudah ada.</p>
                        @endif
                        @error('type')
                            <p class="text-xs text-red-600 mt-2" id="type-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div class="prose max-w-none dark:prose-invert">
                        <label for="content" class="block text-sm font-medium mb-2 dark:text-white">Konten <span class="text-red-500">*</span></label>
                        <x-trix-input id="content" name="content" :value="old('content')" />
                        @error('content')
                            <p class="text-xs text-red-600 mt-2" id="content-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- End Form Group -->
                </div>

                <div class="mt-6 flex justify-start gap-x-2">
                    <a navigate href="{{ route('superadmin.profiles.index') }}"
                        class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 transition-all">
                        Batal
                    </a>
                    <button type="submit" @if(empty($availableTypes)) disabled @endif
                        class="py-2.5 px-6 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none cursor-pointer shadow-md shadow-brand/20 transition-all active:scale-95">
                        @include('_admin._layout.icons.add')
                        Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
