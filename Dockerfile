# ==============================================================================
# STAGE 1: Kompilasi Aset Frontend (Bun)
# ==============================================================================
FROM oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

COPY package.json bun.lockb* ./
# Menggunakan bun install biasa agar tidak error jika file lock belum ada/berubah
RUN bun install

COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime Aplikasi (PHP CLI)
# ==============================================================================
FROM php:8.3-cli AS runner
WORKDIR /app

# 1. Install dependensi OS untuk PHP 8.3 (Debian 12 / Bookworm)
# PERBAIKAN: Dikembalikan ke libzip4 dan libpng16-16 agar apt-get tidak Exit Code 100
RUN apt-get update && apt-get install -y --no-install-recommends \
    libzip4 libpng16-16 libjpeg62-turbo libfreetype6 unzip git curl \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip gd pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. Ambil Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Copy file composer
COPY composer.json composer.lock* ./

# 4. Install dependensi PHP (Bypass memory limit mencegah OOM/RAM penuh)
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 5. Copy seluruh kode aplikasi
COPY --chown=www-data:www-data . /app

# 6. Copy hasil kompilasi aset (Vite) dari STAGE 1
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 7. Optimasi Laravel dengan key dummy
RUN APP_ENV=local APP_KEY=base64:dGhpcy1pcy1hLWR1bW15LWtleS1mb3RetWlkaW5nLW9ubHk= \
    php artisan storage:link \
    && php artisan optimize:clear \
    && php artisan optimize

# 8. Set permission
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000
EXPOSE 8000

# 9. Jalankan aplikasi
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]