# ==============================================================================
# STAGE 1: Frontend Build (Bun)
# ==============================================================================
FROM oven/bun:1.1-slim AS frontend-builder
WORKDIR /build

# Copy file dependency frontend
COPY package.json bun.lock* ./
RUN bun install

# Copy source code dan build asset Vite
COPY . .
RUN bun run build

# ==============================================================================
# STAGE 2: Runtime PHP
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

# 3. Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. Install dependensi PHP (Gunakan --no-scripts agar tidak error saat build karena tidak ada DB/.env)
COPY composer.json composer.lock* ./
RUN COMPOSER_MEMORY_LIMIT=-1 composer install --optimize-autoloader --no-dev --prefer-dist --no-scripts \
    && rm -rf ~/.composer/cache

# 5. Copy seluruh kode sumber
COPY --chown=www-data:www-data . /app

# 6. Copy hasil build Vite dari STAGE 1
COPY --from=frontend-builder --chown=www-data:www-data /build/public/build ./public/build

# 7. Jalankan optimasi Laravel dengan dummy key agar tidak gagal
RUN APP_ENV=local APP_KEY=base64:dGhpcy1pcy1hLWR1bW15LWtleS1mb3RetWlkaW5nLW9ubHk= \
    php artisan storage:link \
    && php artisan optimize:clear \
    && php artisan optimize

# 8. Set permission direktori yang butuh akses tulis
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Buka port 8000
EXPOSE 8000

# 9. Jalankan aplikasi via artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]