@blaze(fold: false)
@props(['name', 'id' => null, 'label' => null, 'value' => null])

@php $uid = $id ?? $name; @endphp

<div class="space-y-2">
    @if ($label ?? false)
        <label class="block text-sm font-medium dark:text-white">{{ $label }}</label>
    @endif

    {{-- Input file di luar label agar tidak ada nested label --}}
    <input id="{{ $uid }}" name="{{ $name }}" type="file" class="hidden" accept="image/*" />

    {{-- Label = klik langsung trigger file picker, tanpa JS click handler --}}
    <label for="{{ $uid }}" id="drop-zone-{{ $uid }}"
        class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-dashed rounded-2xl cursor-pointer bg-gray-50 dark:bg-neutral-900 border-gray-300 dark:border-neutral-700 hover:bg-gray-100 dark:hover:bg-neutral-800 hover:border-brand dark:hover:border-brand transition-all overflow-hidden group shadow-sm">

        {{-- Tombol X — stopPropagation agar tidak trigger label (file picker) --}}
        <button type="button" id="reset-btn-{{ $uid }}"
            onclick="event.preventDefault(); event.stopPropagation(); window['fileUploadReset_{{ $uid }}']();"
            class="hidden absolute top-2 right-2 z-20 size-7 inline-flex items-center justify-center rounded-full bg-white/90 dark:bg-neutral-800/90 text-gray-500 hover:text-red-500 dark:text-neutral-400 dark:hover:text-red-400 shadow-md border border-gray-200 dark:border-neutral-700 transition-all hover:scale-110 active:scale-90"
            title="Hapus / ganti gambar">
            <svg class="size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18" /><path d="m6 6 12 12" />
            </svg>
        </button>

        {{-- Preview --}}
        <div id="preview-container-{{ $uid }}"
            class="{{ $value ? '' : 'hidden' }} absolute inset-0 flex items-center justify-center pointer-events-none">
            <img id="preview-image-{{ $uid }}"
                src="{{ $value ? asset('storage/' . $value) : '#' }}"
                class="max-h-full max-w-full object-contain p-3" />
            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                <div class="flex flex-col items-center gap-2">
                    <svg class="size-8 text-white drop-shadow" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <span class="text-white text-sm font-semibold drop-shadow">Klik atau seret untuk ganti</span>
                </div>
            </div>
        </div>

        {{-- Placeholder --}}
        <div id="placeholder-{{ $uid }}"
            class="{{ $value ? 'hidden' : '' }} flex flex-col items-center justify-center gap-3 pointer-events-none select-none px-6 text-center">
            <div class="p-4 bg-white dark:bg-neutral-800 rounded-full shadow-sm border border-gray-100 dark:border-neutral-700">
                <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-neutral-400">
                    <span class="font-bold text-brand">Klik untuk unggah</span> atau seret &amp; lepas
                </p>
                <p class="text-xs text-gray-400 dark:text-neutral-500 mt-1">PNG, JPG, WEBP atau BMP (Maks. 2MB)</p>
            </div>
        </div>

        {{-- Drag-over indicator --}}
        <div id="dragover-indicator-{{ $uid }}"
            class="hidden absolute inset-0 border-2 border-brand bg-brand/5 rounded-2xl flex items-center justify-center pointer-events-none">
            <div class="flex flex-col items-center gap-2">
                <svg class="size-10 text-brand animate-bounce" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="17 8 12 3 7 8" />
                    <line x1="12" y1="3" x2="12" y2="15" />
                </svg>
                <span class="text-brand font-semibold text-sm">Lepaskan untuk mengunggah</span>
            </div>
        </div>
    </label>

    @error($name)
        <p class="text-xs text-red-600 mt-2" id="{{ $uid }}-error">{{ $message }}</p>
    @enderror
</div>

<script>
(function () {
    const uid              = '{{ $uid }}';
    const fileInput        = document.getElementById(uid);
    const dropZone         = document.getElementById('drop-zone-' + uid);
    const previewContainer = document.getElementById('preview-container-' + uid);
    const previewImage     = document.getElementById('preview-image-' + uid);
    const placeholder      = document.getElementById('placeholder-' + uid);
    const resetBtn         = document.getElementById('reset-btn-' + uid);
    const dragIndicator    = document.getElementById('dragover-indicator-' + uid);

    if (!fileInput || !dropZone) { return; }

    // Tampilkan tombol X hanya jika ada gambar awal
    if ({{ $value ? 'true' : 'false' }}) {
        resetBtn.classList.remove('hidden');
    }

    function showPreview(file) {
        if (!file || !file.type.startsWith('image/')) { return; }
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
            placeholder.classList.add('hidden');
            resetBtn.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Expose reset function globally so inline onclick can call it safely
    window['fileUploadReset_' + uid] = function () {
        fileInput.value = '';
        previewImage.src = '#';
        previewContainer.classList.add('hidden');
        placeholder.classList.remove('hidden');
        resetBtn.classList.add('hidden');
    };

    // File input change — satu-satunya listener untuk preview
    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            showPreview(this.files[0]);
        }
    });

    // Drag & Drop (label tidak intercept drag events, jadi perlu JS)
    let dragCounter = 0;

    dropZone.addEventListener('dragenter', function (e) {
        e.preventDefault();
        dragCounter++;
        dragIndicator.classList.remove('hidden');
    });

    dropZone.addEventListener('dragleave', function () {
        dragCounter--;
        if (dragCounter <= 0) {
            dragCounter = 0;
            dragIndicator.classList.add('hidden');
        }
    });

    dropZone.addEventListener('dragover', function (e) {
        e.preventDefault(); // Wajib agar drop bisa dilakukan
    });

    dropZone.addEventListener('drop', function (e) {
        e.preventDefault();
        dragCounter = 0;
        dragIndicator.classList.add('hidden');

        const files = e.dataTransfer.files;
        if (files.length > 0 && files[0].type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            fileInput.files = dt.files;
            showPreview(files[0]);
        }
    });
})();
</script>
