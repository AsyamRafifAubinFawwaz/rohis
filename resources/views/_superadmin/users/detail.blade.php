@extends('_superadmin._layout.app')

@section('title', 'Detail Akun')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white overflow-hidden shadow-lg rounded-2xl dark:bg-neutral-800 border-2 border-gray-100 dark:border-neutral-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-neutral-700 flex items-center">
                <a href="{{ route('superadmin.users.index') }}"
                    class="py-3 px-3 inline-flex items-center gap-x-2 text-xl rounded-xl border border-gray-200 bg-white text-gray-800 shadow-md hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                    <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </a>
                <div class="ms-3">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                        Detail Akun Pengguna
                    </h2>
                </div>
            </div>

            <div class="p-6">
                <div class="flex items-center gap-x-6 mb-8">
                    <div class="inline-flex items-center justify-center size-24 rounded-full bg-brand-light text-brand text-4xl font-bold dark:bg-brand-dark/30 dark:text-brand-light border-4 border-brand/10">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $user->name }}</h3>
                        <p class="text-gray-500 dark:text-neutral-400 font-medium">{{ $user->email }}</p>
                        <div class="mt-3 flex gap-2">
                             @if($user->access_type == \App\Constants\UserConst::SUPERADMIN)
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-purple-100 text-purple-800 dark:bg-purple-800/30 dark:text-purple-400 uppercase tracking-wider">Super Admin</span>
                            @else
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-400 uppercase tracking-wider">Admin</span>
                            @endif
                            @if($user->trashed())
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-400 uppercase tracking-wider">Nonaktif</span>
                            @else
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-800/30 dark:text-emerald-400 uppercase tracking-wider">Aktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-4 bg-gray-50 rounded-2xl dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700">
                        <p class="text-xs text-gray-400 dark:text-neutral-500 uppercase tracking-widest font-bold mb-1.5">Terdaftar Pada</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                            {{ $user->created_at->format('d F Y, H:i') }}
                        </p>
                        <p class="text-xs text-gray-400 dark:text-neutral-500 mt-1">
                            {{ $user->created_at->diffForHumans() }}
                        </p>
                    </div>

                    @if ($user->updated_at)
                        <div class="p-4 bg-gray-50 rounded-2xl dark:bg-neutral-900/50 border border-gray-100 dark:border-neutral-700">
                            <p class="text-xs text-gray-400 dark:text-neutral-500 uppercase tracking-widest font-bold mb-1.5">Terakhir Diupdate</p>
                            <p class="text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                {{ $user->updated_at->format('d F Y, H:i') }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-neutral-500 mt-1">
                                {{ $user->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="mt-8 flex gap-x-3">
                    <a navigate href="{{ route('superadmin.users.update', $user->id) }}"
                        class="py-2.5 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-xl bg-brand text-white hover:bg-brand-dark shadow-md shadow-brand/20 transition-all active:scale-95">
                        @include('_superadmin._layout.icons.pencil')
                        Edit Akun
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
