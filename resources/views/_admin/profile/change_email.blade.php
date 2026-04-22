@extends(Auth::user()->access_type == \App\Constants\UserConst::SUPERADMIN ? '_superadmin._layout.app' : '_admin._layout.app')

@section('title', 'Ubah Email')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div
            class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Ubah Email
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-neutral-400">
                        Gunakan form di bawah untuk memperbarui alamat email Anda.
                    </p>
                </div>
            </div>

            <form id="change-email-form" class="p-6" navigate-form
                action="{{ route('admin.profile.do_change_email') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    {{-- Current Email Info --}}
                    <div>
                        <label class="block text-sm font-medium mb-2 dark:text-white">Email Saat Ini</label>
                        <div class="relative">
                            <input type="text" value="{{ Auth::user()->email }}" disabled
                                class="py-3 px-4 ps-11 block w-full bg-gray-50 border-gray-200 rounded-lg text-sm dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- New Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium mb-2 dark:text-white">Email Baru <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="email" id="email" name="email"
                                class="py-3 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('email') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Masukkan email baru anda" required value="{{ old('email') }}">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 17a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9.5C2 7 4 5 6.5 5H18c2.2 0 4 1.8 4 4v8Z"></path>
                                    <polyline points="15,9 18,9 18,11"></polyline>
                                    <path d="M6.5 5C9 5 11 7 11 9.5V17a2 2 0 0 1-2 2"></path>
                                    <line x1="6" y1="10" x2="6" y2="10"></line>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Current Password --}}
                    <div>
                        <label for="current_password" class="block text-sm font-medium mb-2 dark:text-white">Konfirmasi Password
                            <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input type="password" id="current_password" name="current_password"
                                class="py-3 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 placeholder-neutral-300 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 @error('current_password') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
                                placeholder="Masukkan password anda untuk konfirmasi" required>
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>
                        </div>
                        @error('current_password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-8 flex justify-start gap-x-3">
                    <button type="submit"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none cursor-pointer transition-colors shadow-sm">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a navigate href="{{ url()->previous() }}"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
