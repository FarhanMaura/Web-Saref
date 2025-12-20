FROM php:8.2-fpm

# Install system deps + nginx
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip \
    && apt-get clean

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set workdir
WORKDIR /var/www/html

# Copy project
COPY . .

# Install Laravel deps
RUN composer install --no-dev --optimize-autoloader

# Permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Nginx config
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Laravel env
ENV APP_ENV=production
ENV APP_DEBUG=false

# Start services
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"
