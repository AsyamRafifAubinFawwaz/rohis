@blaze(fold: false)
@props(['name', 'id' => null, 'label' => null, 'value' => null])
<div class="space-y-2">
    @if ($label ?? false)
        <label for="{{ $id ?? $name }}" class="block text-sm font-medium dark:text-white">{{ $label }}</label>
    @endif
    <div id="drop-zone-{{ $id ?? $name }}"
        class="relative flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-2xl cursor-pointer bg-gray-50 dark:hover:bg-neutral-800 dark:bg-neutral-900 hover:bg-gray-100 dark:border-neutral-700 dark:hover:border-neutral-600 transition-all overflow-hidden group shadow-sm">
        <div id="preview-container-{{ $id ?? $name }}"
            class="{{ $value ?? false ? '' : 'hidden' }} absolute inset-0 size-full flex items-center justify-center bg-gray-50 dark:bg-neutral-900 rounded-2xl">
            <img id="preview-image-{{ $id ?? $name }}" src="{{ $value ?? false ? asset('storage/' . $value) : '#' }}"
                class="max-h-full max-w-full object-contain p-2" />
            <div
                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                <div class="flex flex-col items-center gap-2">
                    <svg class="size-8 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="17 8 12 3 7 8" />
                        <line x1="12" y1="3" x2="12" y2="15" />
                    </svg>
                    <span class="text-white text-sm font-semibold">Ganti Gambar</span>
                </div>
            </div>
        </div>

        <div id="placeholder-{{ $id ?? $name }}"
            class="{{ $value ?? false ? 'hidden' : '' }} flex flex-col items-center justify-center pt-5 pb-6">
            <div
                class="p-4 bg-white dark:bg-neutral-800 rounded-full shadow-sm mb-4 border border-gray-100 dark:border-neutral-700">
                <svg class="w-8 h-8 text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                    </path>
                </svg>
            </div>
            <p class="mb-2 text-sm text-gray-500 dark:text-neutral-400"><span
                    class="font-bold text-brand hover:underline">Klik untuk unggah</span> atau seret dan lepas</p>
            <p class="text-xs text-gray-400 dark:text-neutral-500">PNG, JPG, BMP atau WEBP (Maks. 2MB)</p>
        </div>

        <input id="{{ $id ?? $name }}" name="{{ $name }}" type="file" class="hidden" accept="image/*" />
    </div>
    @error($name)
        <p class="text-xs text-red-600 mt-2" id="{{ $id ?? $name }}-error">{{ $message }}</p>
    @enderror
</div>

<script>
    (function() {
        const initUpload = () => {
            const dropZone = document.getElementById('drop-zone-{{ $id ?? $name }}');
            const fileInput = document.getElementById('{{ $id ?? $name }}');
            const previewContainer = document.getElementById('preview-container-{{ $id ?? $name }}');
            const previewImage = document.getElementById('preview-image-{{ $id ?? $name }}');
            const placeholder = document.getElementById('placeholder-{{ $id ?? $name }}');

            if (!dropZone || !fileInput) return;

            const updatePreview = (file) => {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                        placeholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            };

            dropZone.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    updatePreview(e.target.files[0]);
                }
            });

            ['dragover', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                });
            });

            dropZone.addEventListener('dragenter', () => {
                dropZone.classList.add('border-brand', 'bg-brand/5', 'ring-4', 'ring-brand/10');
            });

            dropZone.addEventListener('dragover', () => {
                dropZone.classList.add('border-brand', 'bg-brand/5', 'ring-4', 'ring-brand/10');
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-brand', 'bg-brand/5', 'ring-4',
                        'ring-brand/10');
                });
            });

            dropZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length > 0 && files[0].type.startsWith('image/')) {
                    fileInput.files = files; // Works in modern browsers
                    updatePreview(files[0]);

                    // Trigger manual change event just in case
                    const event = new Event('change', {
                        bubbles: true
                    });
                    fileInput.dispatchEvent(event);
                }
            });
        };

        // Handle both standard load and SPA navigation
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initUpload);
        } else {
            initUpload();
        }

        // Listen for SPA content updates if your admin-custom.js dispatches an event
        // or just re-run on DOM insertion if needed. 
        // Given your SPA script re-executes scripts, this (function(){})() will re-run.
    })();
</script>
