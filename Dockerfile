# ==============================================================================
# STAGE 1: Frontend Build (Bun)
# ==============================================================================
FROM oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

COPY package.json bun.lock* ./
RUN bun install

COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Backend Dependencies (Composer)
# ==============================================================================
FROM composer:2 AS composer-builder
WORKDIR /app

# Hanya copy file composer untuk caching layer
COPY composer.json composer.lock* ./

# Install dependensi PHP (Gunakan --ignore-platform-reqs agar tidak error jika ekstensi PHP belum ada di image composer)
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts --ignore-platform-reqs

# ==============================================================================
# STAGE 3: Runtime PHP
# ==============================================================================
FROM php:8.3-cli AS runner
WORKDIR /app

# 1. Install tool esensial OS
RUN apt-get update && apt-get install -y --no-install-recommends \
    unzip git curl \
    && rm -rf /var/lib/apt/lists/*

# 2. Install PHP Extensions dengan script official (otomatis handle dependensi OS & cleanup)
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions \
    gd \
    pdo_mysql \
    zip \
    redis \
    pcntl \
    opcache

# 3. Copy seluruh kode sumber dari host
COPY --chown=www-data:www-data . /app

# 4. Copy direktori vendor hasil build Composer dari STAGE 2
COPY --from=composer-builder --chown=www-data:www-data /app/vendor ./vendor

# 5. Copy hasil build Vite dari STAGE 1
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 6. Jalankan optimasi Laravel dengan dummy key agar tidak gagal
RUN APP_ENV=local APP_KEY=base64:nO3/QHMIH8Bv5nTQgi9XXOBeNU/+rDX9jbR0vqmj8Ec= DB_DATABASE=:memory: \
    php artisan storage:link --force \
    && php artisan optimize:clear \
    && php artisan optimize

# 7. Set permission direktori yang butuh akses tulis
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000
EXPOSE 8000

# 8. Jalankan aplikasi via artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]