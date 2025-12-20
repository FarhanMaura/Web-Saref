# Gunakan PHP 8.2 FPM
FROM php:8.2-fpm

# Install dependencies dan Nginx
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip nginx \
    && docker-php-ext-install pdo pdo_mysql zip

# Copy file project ke container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Expose port 80
EXPOSE 80

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
