FROM php:8.2-fpm

# Install system deps + nginx + envsubst
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libzip-dev \
    libsqlite3-dev \
    gettext \
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

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Copy nginx template
COPY nginx.conf.template /etc/nginx/templates/default.conf.template

# Laravel env
ENV APP_ENV=production
ENV APP_DEBUG=false

# Start PHP-FPM + Nginx
CMD sh -c "\
    export PORT=\${PORT:-8080} && \
    echo \"Using PORT=\$PORT\" && \
    envsubst '\$PORT' < /etc/nginx/templates/default.conf.template > /etc/nginx/conf.d/default.conf && \
    nginx -t && \
    php-fpm -D && \
    nginx -g 'daemon off;'"

