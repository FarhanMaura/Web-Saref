#!/bin/bash
set -e

# Set default PORT if not provided
export PORT=${PORT:-8080}

echo "Starting services on PORT: $PORT"

# Create SQLite database if using SQLite
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
fi

# Run Laravel optimizations
echo "Running Laravel optimizations..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Replace PORT placeholder in nginx config
envsubst '${PORT}' < /etc/nginx/sites-available/default > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/sites-available/default

# Test nginx configuration
nginx -t

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Wait a moment for PHP-FPM to fully start
sleep 2

# Start Nginx in foreground
echo "Starting Nginx..."
nginx -g 'daemon off;'
