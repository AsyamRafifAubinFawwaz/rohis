@extends('_superadmin._layout.app')

@section('title', 'Tambah Program Kerja')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center justify-between">
                <div class="flex items-center">
                    <a navigate href="{{ route('superadmin.programs.index') }}"
                        class="size-10 inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 transition-all active:scale-90">
                        @include('_admin._layout.icons.close_modal')
                    </a>
                    <div class="ms-3">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                            Tambah Program Kerja Baru
                        </h2>
                        <p class="text-xs text-gray-400 dark:text-neutral-500 mt-0.5">Lengkapi informasi program kerja organisasi</p>
                    </div>
                </div>
            </div>

            <form navigate-form action="{{ route('superadmin.programs.create') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Left Column: Form Fields -->
                    <div class="lg:col-span-7 space-y-6">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-neutral-200 mb-2 uppercase tracking-wide">
                                Nama Program <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-xs @error('name') border-red-500 @enderror"
                                required placeholder="Masukkan nama program kerja...">
                            @error('name')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700 dark:text-neutral-200 mb-2 uppercase tracking-wide">
                                Deskripsi <span class="text-xs font-normal text-gray-400 normal-case">(Opsional)</span>
                            </label>
                            <textarea id="description" name="description" rows="5"
                                class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300 shadow-xs"
                                placeholder="Jelaskan detail tujuan dan lingkup program ini...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-bold text-gray-700 dark:text-neutral-200 mb-2 uppercase tracking-wide">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                                    required>
                                @error('start_date')
                                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-bold text-gray-700 dark:text-neutral-200 mb-2 uppercase tracking-wide">
                                    Tanggal Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-xl text-sm focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300"
                                    required>
                                @error('end_date')
                                    <p class="text-xs text-red-600 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                      
                    </div>

                    <!-- Right Column: Image Upload -->
                    <div class="lg:col-span-5 space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-neutral-200 mb-2 uppercase tracking-wide text-center lg:text-start">
                                Poster / Gambar Program
                            </label>
                            <x-admin.file-upload name="image" id="image" label="" />
                            <p class="text-[10px] text-gray-400 dark:text-neutral-500 mt-2 italic text-center uppercase tracking-tighter font-semibold">
                                Direkomendasikan rasio 16:9 untuk tampilan terbaik
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 dark:border-neutral-700 flex justify-end gap-x-3">
                    <a navigate href="{{ route('superadmin.programs.index') }}"
                        class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-hidden dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 transition-all active:scale-95">
                        Batal
                    </a>
                    <button type="submit"
                        class="py-3 px-8 inline-flex items-center gap-x-2 text-sm font-bold rounded-xl border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-none focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none cursor-pointer shadow-md shadow-brand/20 transition-all active:scale-95">
                        @include('_admin._layout.icons.add')
                        Simpan Program Kerja
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
