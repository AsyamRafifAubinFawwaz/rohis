@extends('_landing._layout.app')
@section('title', 'Visi & Misi')

@section('content')
<div class="pt-28 pb-24 bg-neutral-50 dark:bg-neutral-950 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Visi & Misi -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mb-20" data-aos="fade-up">
            
            <!-- Visi -->
            <div class="bg-emerald-50 dark:bg-neutral-900 rounded-2xl p-10 lg:p-14 text-center h-full flex flex-col items-center border border-emerald-100 dark:border-neutral-800 shadow-sm transition-transform hover:-translate-y-1 duration-300">
                <div class="w-16 h-16 rounded-full bg-emerald-100/80 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <h2 class="text-2xl lg:text-3xl font-bold text-neutral-900 dark:text-white mb-6">Visi</h2>
                <div class="text-neutral-600 dark:text-neutral-400 text-base lg:text-lg leading-relaxed font-medium">
                    {!! $vision ? $vision->content : '"Terwujudnya lulusan yang berprofil Pelajar Pancasila sehingga mampu bersaing di dunia kerja dan Perguruan Tinggi, serta tumbuh jiwa wirausaha."' !!}
                </div>
            </div>

            <!-- Misi -->
            <div class="bg-emerald-50 dark:bg-neutral-900 rounded-2xl p-10 lg:p-14 h-full flex flex-col items-center border border-emerald-100 dark:border-neutral-800 shadow-sm transition-transform hover:-translate-y-1 duration-300">
                <div class="w-16 h-16 rounded-full bg-emerald-100/80 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <img src="{{ asset('favicon/misi.svg') }}" alt="Misi" class="w-8 h-8">
                </div>
                <h2 class="text-2xl lg:text-3xl font-bold text-neutral-900 dark:text-white mb-6">Misi</h2>
                <div class="text-neutral-600 dark:text-neutral-400 text-sm lg:text-base leading-relaxed prose dark:prose-invert prose-p:my-2 prose-ol:pl-4 prose-ul:pl-4 max-w-none text-left w-full">
                    {!! $mission ? $mission->content : '
                        <ol class="list-[lower-alpha] space-y-2">
                            <li>Meningkatkan softskill peserta didik yang berprofil pelajar Pancasila.</li>
                            <li>Mensinkronkan Kurikulum secara kontekstual terhadap tuntutan dunia kerja.</li>
                            <li>Menerapkan pembelajaran yang berpusat pada peserta didik.</li>
                        </ol>
                    ' !!}
                </div>
            </div>

        </div>

        <!-- Nilai Nilai Utama -->
        <div class="text-center mb-10" data-aos="fade-up" data-aos-delay="100">
            <h2 class="text-3xl lg:text-4xl font-black text-neutral-900 dark:text-white tracking-tight">Nilai Nilai Utama</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" data-aos="fade-up" data-aos-delay="200">
            
            <!-- Card 1 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Religius</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Menghayati dan mengamalkan ajaran agama dalam kehidupan sehari-hari.
                </p>
            </div>

            <!-- Card 2 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Jujur</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Berperilaku dapat dipercaya dalam perkataan, tindakan, dan pekerjaan.
                </p>
            </div>

            <!-- Card 3 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Disiplin</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Tertib dan patuh pada berbagai ketentuan dan peraturan.
                </p>
            </div>

            <!-- Card 4 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Tanggung Jawab</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Setiap siswa harus melaksanakan tugas dan kewajibannya.
                </p>
            </div>

            <!-- Card 5 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Kreatif</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Berpikir dan melakukan sesuatu untuk menghasilkan cara atau hasil baru.
                </p>
            </div>

            <!-- Card 6 -->
            <div class="bg-white dark:bg-neutral-900 rounded-2xl p-8 border border-neutral-200 dark:border-neutral-800 shadow-sm hover:border-emerald-300 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <h3 class="text-xl font-bold text-neutral-900 dark:text-white mb-3">Mandiri</h3>
                <p class="text-neutral-500 dark:text-neutral-400 text-sm leading-relaxed">
                    Sikap dan perilaku yang tidak mudah tergantung pada orang lain.
                </p>
            </div>

        </div>

    </div>
</div>
@endsection
