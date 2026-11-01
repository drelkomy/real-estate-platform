# ==============================================================================
# Real Estate Platform — Container Dockerfile
# Multi-stage: Composer → Node.js (Vite Build) → PHP 8.5.12 FPM / Nginx / Supervisor
# ==============================================================================

# --- Stage 1: Install Composer Dependencies ---
FROM composer:2 AS vendor-builder
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --prefer-dist \
    --no-interaction
COPY . .
RUN mkdir -p bootstrap/cache storage/framework/{sessions,views,cache} storage/logs \
    && composer dump-autoload --optimize --no-dev --no-scripts --ignore-platform-reqs

# --- Stage 2: Build Frontend Assets with Node.js & Vite ---
FROM node:20-alpine AS frontend
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --no-audit --prefer-offline
COPY . .
COPY --from=vendor-builder /app/vendor ./vendor
RUN npm run build

# --- Stage 3: PHP-FPM + Nginx Runtime (PHP 8.5.12 Alpine) ---
FROM php:8.5.12-fpm-alpine

WORKDIR /var/www/html

# Install system dependencies & build tools
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    unzip \
    bash \
    redis \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    libxml2-dev \
    icu-dev \
    oniguruma-dev \
    netcat-openbsd \
    $PHPIZE_DEPS

# Configure and install PHP extensions
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        bcmath \
        gd \
        zip \
        intl \
        pcntl \
        exif

# Install redis extension from source for PHP 8.5 compatibility
RUN git clone --depth=1 https://github.com/phpredis/phpredis.git /tmp/phpredis \
    && cd /tmp/phpredis \
    && phpize \
    && ./configure \
    && make -j$(nproc) \
    && make install \
    && docker-php-ext-enable redis \
    && rm -rf /tmp/phpredis \
    && apk del $PHPIZE_DEPS \
    && rm -rf /var/cache/apk/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy configuration files
COPY docker/nginx.conf         /etc/nginx/http.d/default.conf
COPY docker/php.ini            /usr/local/etc/php/conf.d/99-custom.ini
COPY docker/php-fpm-pool.conf   /usr/local/etc/php-fpm.d/zz-app.conf
COPY docker/supervisord.conf   /etc/supervisor/conf.d/supervisord.conf
RUN ln -sf /etc/supervisor/conf.d/supervisord.conf /etc/supervisord.conf
COPY docker/entrypoint.sh      /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy application source code
COPY . /var/www/html

# Overlay pre-built vendor
COPY --from=vendor-builder /app/vendor /var/www/html/vendor

# Overlay built Vite assets
COPY --from=frontend /app/public/build /var/www/html/public/build

# Setup permissions
RUN mkdir -p \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/framework/views \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/logs \
        /var/www/html/storage/app/public \
        /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
    && chmod -R 775 \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
    && chmod -R -x+X \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache

EXPOSE 80 3000

HEALTHCHECK --interval=15s --timeout=5s --start-period=30s --retries=3 \
    CMD curl -f http://localhost:80/up || curl -f http://localhost:3000/up || exit 1

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
