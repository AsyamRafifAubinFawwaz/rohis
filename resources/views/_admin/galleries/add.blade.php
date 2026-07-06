@extends('_admin._layout.app')

@section('title', 'Unggah Foto Baru')

@section('content')
    <div class="max-w-[85rem] mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-y-10 lg:gap-y-0 lg:gap-x-12">
            <!-- Left Side: Information & Instructions -->
            <div class="lg:col-span-1">
                <div class="sticky top-10">
                    <h2 class="text-3xl font-extrabold text-gray-800 dark:text-neutral-200 tracking-tight mb-4">
                        Unggah Dokumentasi
                    </h2>
                    <p class="text-gray-500 dark:text-neutral-500 mb-8 leading-relaxed">
                        Bagikan momen berharga dari kegiatan Rohis Anda. Foto yang Anda unggah akan menjadi bagian dari galeri publik yang dapat menginspirasi anggota lainnya.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex gap-x-3">
                            <span class="size-6 flex justify-center items-center rounded-full bg-brand/10 text-brand dark:bg-brand/20">
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            <div class="grow">
                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200 uppercase tracking-wide">Pilih Kegiatan</span>
                                <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Pastikan foto ditautkan ke kegiatan yang sesuai.</p>
                            </div>
                        </li>
                        <li class="flex gap-x-3">
                            <span class="size-6 flex justify-center items-center rounded-full bg-brand/10 text-brand dark:bg-brand/20">
                                <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                            </span>
                            <div class="grow">
                                <span class="text-sm font-bold text-gray-800 dark:text-neutral-200 uppercase tracking-wide">Format Gambar</span>
                                <p class="text-xs text-gray-500 dark:text-neutral-500 mt-1">Gunakan format JPG, PNG, atau WEBP berkualitas tinggi.</p>
                            </div>
                        </li>
                    </ul>

                    <div class="mt-12 p-5 bg-gray-50 dark:bg-neutral-800/50 rounded-3xl border border-gray-100 dark:border-neutral-700/50 shadow-sm">
                         <div class="flex gap-3 items-center mb-2">
                             <div class="size-8 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 dark:bg-yellow-900/30">
                                 <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                             </div>
                             <h4 class="text-sm font-bold text-gray-800 dark:text-neutral-200">Tips Unggah</h4>
                         </div>
                         <p class="text-xs text-gray-500 dark:text-neutral-500 leading-relaxed">
                             Ukuran file maksimal adalah 2MB. Foto dengan orientasi landscape biasanya terlihat lebih baik di galeri.
                         </p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-neutral-800 rounded-[2.5rem] border border-gray-100 dark:border-neutral-700 shadow-2xl overflow-hidden">
                    <!-- Form Header -->
                    <div class="px-8 py-6 border-b border-gray-100 dark:border-neutral-700 flex items-center justify-between bg-gray-50/50 dark:bg-neutral-900/20">
                        <div class="flex items-center gap-3">
                             <a navigate href="{{ route('admin.galleries.index') }}" class="p-2 rounded-xl bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 text-gray-500 hover:text-brand transition-all shadow-sm active:scale-90">
                                <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                             </a>
                             <h3 class="font-black text-gray-800 dark:text-neutral-200 tracking-tight">Formulir Galeri</h3>
                        </div>
                    </div>

                    <form navigate-form action="{{ route('admin.galleries.doCreate') }}" method="POST"
                        enctype="multipart/form-data" class="p-8 sm:p-12">
                        @csrf
                        <div class="space-y-10">
                            <!-- Input Group: Title -->
                            <div class="relative group">
                                <label for="title" class="block text-xs font-black uppercase tracking-widest text-gray-400 dark:text-neutral-500 mb-3 group-focus-within:text-brand transition-colors">
                                    Judul / Keterangan Foto <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                    class="py-4 px-0 w-full bg-transparent border-t-0 border-x-0 border-b-2 border-gray-200 text-lg font-bold text-gray-800 placeholder:text-gray-300 focus:ring-0 focus:border-brand dark:border-neutral-700 dark:text-neutral-200 dark:placeholder:text-neutral-600 transition-all"
                                    required placeholder="Tuliskan judul yang menarik untuk foto ini...">
                                @error('title')
                                    <p class="text-xs text-red-600 mt-2 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input Group: Activity -->
                            <div>
                                <label for="activity_id" class="block text-xs font-black uppercase tracking-widest text-gray-400 dark:text-neutral-500 mb-3">
                                    Tautkan ke Kegiatan (Opsional)
                                </label>
                                
                                <select id="activity_id" name="activity_id" data-hs-select='{
                                    "hasSearch": true,
                                    "searchPlaceholder": "Cari kegiatan...",
                                    "searchClasses": "block w-full text-sm bg-transparent border-gray-200 rounded-lg text-gray-800 placeholder:text-gray-400 focus:border-brand focus:ring-brand dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 py-2 px-3",
                                    "searchWrapperClasses": "bg-white dark:bg-neutral-800 p-2 sticky top-0 border-b border-gray-100 dark:border-neutral-700",
                                    "placeholder": "Tidak Ditautkan",
                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"><span class=\"me-2\" data-icon></span><span class=\"text-gray-800 dark:text-neutral-200 font-bold\" data-title></span></button>",
                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-4 ps-5 pe-9 flex text-nowrap w-full cursor-pointer bg-gray-50 dark:bg-neutral-900/50 border border-transparent text-gray-800 dark:text-neutral-200 rounded-2xl text-start text-sm hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:hover:bg-neutral-800 shadow-sm transition-all",
                                    "dropdownClasses": "mt-2 max-h-72 pb-1 px-1 space-y-0.5 z-20 w-full bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-2xl shadow-2xl overflow-hidden overflow-y-auto",
                                    "optionClasses": "hs-selected:bg-brand-light dark:hs-selected:bg-brand/20 py-3 px-4 w-full text-sm text-gray-800 dark:text-neutral-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-neutral-700 rounded-xl focus:outline-hidden",
                                    "optionTemplate": "<div><div class=\"flex items-center\"><div class=\"me-3\" data-icon></div><div class=\"text-gray-800 dark:text-neutral-200 font-bold\" data-title></div></div></div>",
                                    "extraMarkup": "<div class=\"absolute top-1/2 end-4 -translate-y-1/2\"><svg class=\"shrink-0 size-4 text-gray-400\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"3\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                }' class="hidden">
                                    <option value="">Tidak Ditautkan</option>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->id }}" 
                                            {{ old('activity_id') == $activity->id ? 'selected' : '' }}
                                            data-hs-select-option='{
                                                "icon": "<div class=\"size-8 rounded-lg bg-brand/10 flex items-center justify-center text-brand\"><svg class=\"size-4\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect width=\"18\" height=\"18\" x=\"3\" y=\"4\" rx=\"2\" ry=\"2\"/><line x1=\"16\" y1=\"2\" x2=\"16\" y2=\"6\"/><line x1=\"8\" y1=\"2\" x2=\"8\" y2=\"6\"/><line x1=\"3\" y1=\"10\" x2=\"21\" y2=\"10\"/></svg></div>"
                                            }'>
                                            {{ $activity->title }} ({{ \Carbon\Carbon::parse($activity->event_date)->format('Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('activity_id')
                                    <p class="text-xs text-red-600 mt-2 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Input Group: Image -->
                            <div class="pt-4">
                                <label class="block text-xs font-black uppercase tracking-widest text-gray-400 dark:text-neutral-500 mb-6">
                                    Unggah File Foto <span class="text-red-500">*</span>
                                </label>
                                <div class="bg-gray-50/50 dark:bg-neutral-900/30 p-2 rounded-[2rem] border border-gray-100 dark:border-neutral-800/50 shadow-inner">
                                     <x-admin.file-upload name="image" id="image" />
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="pt-8 flex flex-col sm:flex-row gap-3">
                                <button type="submit"
                                    class="order-1 sm:order-2 flex-1 py-4 px-8 inline-flex justify-center items-center gap-x-3 text-sm font-black uppercase tracking-widest rounded-2xl border border-transparent bg-brand text-white hover:bg-brand-dark transition-all active:scale-95 shadow-xl shadow-brand/20 cursor-pointer">
                                    @include('_admin._layout.icons.add')
                                    Terbitkan Foto
                                </button>
                                <a navigate href="{{ route('admin.galleries.index') }}"
                                    class="order-2 sm:order-1 py-4 px-8 inline-flex justify-center items-center text-sm font-bold rounded-2xl border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-400 dark:hover:bg-neutral-800 transition-all active:scale-95 shadow-sm">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
