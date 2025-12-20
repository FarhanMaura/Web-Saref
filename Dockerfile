# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Force rebuild - updated 2025-12-20
ARG CACHEBUST=1

# Install dependencies dan Nginx
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip nginx gettext-base sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite zip

# Copy file project ke container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Create database directory and set permissions
RUN mkdir -p /var/www/html/database && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Set default PORT environment variable
ENV PORT=8080

# Expose port
EXPOSE ${PORT}

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
