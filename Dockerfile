# Use official PHP 8.2 with FPM
FROM php:8.2-fpm

# 1. Set working directory
WORKDIR /var/www/html

# 2. Install system dependencies & PHP extensions
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       git \
       curl \
       zip \
       unzip \
       libonig-dev \
       libxml2-dev \
       libzip-dev \
       libpq-dev \
       libpng-dev \
       libjpeg-dev \
       libfreetype6-dev \
    && docker-php-ext-install \
       pdo_mysql \
       mbstring \
       zip \
       exif \
       pcntl \
       bcmath \
    && rm -rf /var/lib/apt/lists/*

# 3. Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Increase Composer memory limit
ENV COMPOSER_MEMORY_LIMIT=-1

# 5. Copy only the files needed to install PHP deps, then install
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --prefer-dist \
    --no-interaction

# 6. Now copy the rest of your app
COPY . .

# ── If you’re using Node/Vite for asset building, you can uncomment this:
# RUN apt-get update \
#     && apt-get install -y nodejs npm \
#     && npm ci \
#     && npm run build \
#     && rm -rf node_modules

# 7. Set folder permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 storage bootstrap/cache

# 8. Expose port & start Laravel
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
