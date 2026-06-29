# ==============================================================================
# STAGE 1: Kompilasi Aset Frontend (Bun)
# ==============================================================================
FROM oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

COPY package.json bun.lockb* ./
RUN bun install

COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime Aplikasi (PHP CLI)
# ==============================================================================
FROM php:8.3-cli AS runner
WORKDIR /app

# 1. Install dependensi OS (Disederhanakan agar terhindar dari Exit Code 100)
# Menggunakan package -dev standar, Debian akan otomatis menarik runtime yang benar.
RUN apt-get update && apt-get install -y --no-install-recommends \
    unzip git curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) zip gd pdo pdo_mysql \
    && pecl install redis && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

# 2. Ambil Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Copy file composer
COPY composer.json composer.lock* ./

# 4. Install dependensi PHP
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 5. Copy seluruh kode aplikasi
COPY --chown=www-data:www-data . /app

# 6. Copy hasil kompilasi aset dari STAGE 1
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