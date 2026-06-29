# ==============================================================================
# STAGE 1: Kompilasi Aset Frontend (Bun)
# ==============================================================================
# Catatan: --platform=linux/amd64 dihapus untuk menghindari warning BuildKit.
# Jika Anda wajib build khusus untuk arsitektur AMD64 di mesin ARM, 
# cukup tambahkan flag saat menjalankan perintah: docker build --platform linux/amd64 ...
FROM oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

COPY package.json bun.lockb* ./
RUN bun install --frozen-lockfile

COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime Aplikasi (PHP CLI)
# ==============================================================================
FROM php:8.3-cli AS runner
WORKDIR /app

# 1. Install dependensi OS (Pemisahan antara runtime libs dan dev/build tools)
# PERBAIKAN: Nama paket runtime di Debian 13 (Trixie) telah berubah:
# - libzip4 -> libzip5
# - libpng16-16 -> libpng16-16t64
RUN apt-get update && apt-get install -y --no-install-recommends \
    # Library runtime yang WAJIB tetap ada di container (Update nama paket Trixie)
    libzip5 libpng16-16t64 libjpeg62-turbo libfreetype6 unzip git \
    # Library dev yang hanya dibutuhkan saat COMPILING ekstensi
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip gd pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis \
    # Hapus HANYA paket -dev agar hemat ruang. 
    # Paket runtime di atas aman karena terinstall manual, tidak akan terhapus oleh --auto-remove
    && apt-get purge -y --auto-remove libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Ambil Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Copy file composer untuk caching layer
COPY composer.json composer.lock ./

# 4. Install dependensi PHP (Sekarang pasti aman karena ext-gd & ext-zip sudah aktif)
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 5. Copy seluruh kode aplikasi Laravel ke dalam container
COPY --chown=www-data:www-data . /app

# 6. Copy hasil kompilasi aset (Vite) dari STAGE 1
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 7. Jalankan optimasi Laravel dengan key dummy agar tidak error saat build
RUN APP_ENV=local APP_KEY=base64:dGhpcy1pcy1hLWR1bW15LWtleS1mb3RetWlkaW5nLW9ubHk= \
    php artisan storage:link \
    && php artisan optimize

# 8. Set permission untuk folder storage dan cache
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000
EXPOSE 8000

# 9. Jalankan aplikasi menggunakan php artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]