@blaze(fold: false)
@props([
    'id',
    'title' => 'Modal Title',
    'formId' => null,
    'method' => 'POST',
    'action' => '',
    'navigate' => true,
    'size' => 'sm:max-w-lg',
    'footer' => null,
    'enctype' => null,
])

<div id="{{ $id }}"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="{{ $id }}-label">
    <div
        class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 {{ $size }} sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
        <div
            class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
                <h3 id="{{ $id }}-label" class="font-bold text-gray-800 dark:text-white">
                    {{ $title }}
                </h3>
                <button type="button"
                    class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600"
                    aria-label="Close" data-hs-overlay="#{{ $id }}">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            @if ($formId)
                <form id="{{ $formId }}" action="{{ $action }}" method="{{ $method }}"
                    {{ $navigate ? 'navigate-form' : '' }}
                    @if ($enctype) enctype="{{ $enctype }}" @endif>
                    @if (strtoupper($method) !== 'GET')
                        @csrf
                    @endif
            @endif

            <div class="p-4 overflow-y-auto">
                {{ $slot }}
            </div>

            <div
                class="flex justify-end items-center gap-x-2 py-3 px-4 border-t border-gray-200 dark:border-neutral-700">
                @if ($footer)
                    {{ $footer }}
                @else
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#{{ $id }}">
                        Batal
                    </button>
                    <button type="submit" @if ($formId) form="{{ $formId }}" @endif
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-brand text-white hover:bg-brand-dark focus:outline-hidden focus:bg-brand-dark disabled:opacity-50 disabled:pointer-events-none">
                        Simpan
                    </button>
                @endif
            </div>

            @if ($formId)
                </form>
            @endif
        </div>
    </div>
</div>
