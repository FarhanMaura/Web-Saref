#!/bin/bash
# Removed set -e to prevent premature exit on errors

# Set default PORT if not provided
export PORT=${PORT:-8080}

echo "========================================="
echo "Starting Web-Saref Laravel Application"
echo "========================================="
echo "PORT: $PORT"
echo "PWD: $(pwd)"
echo "PHP Version: $(php -v | head -n 1)"
echo "========================================="

# Check if Laravel is installed
if [ ! -f /var/www/html/artisan ]; then
    echo "ERROR: Laravel artisan file not found!"
    ls -la /var/www/html/
    exit 1
fi

# Create SQLite database if using SQLite
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite
    chmod 664 /var/www/html/database/database.sqlite
    echo "SQLite database created successfully"
else
    echo "SQLite database already exists"
fi

# Test Laravel
echo "Testing Laravel installation..."
php artisan --version || echo "WARNING: Laravel artisan failed"

# Run Laravel optimizations (temporarily disabled for debugging)
echo "Skipping Laravel optimizations for debugging..."
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

# Replace PORT placeholder in nginx config
echo "Configuring Nginx for PORT $PORT..."
envsubst '${PORT}' < /etc/nginx/sites-available/default > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/sites-available/default

# Test nginx configuration
echo "Testing Nginx configuration..."
nginx -t

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Wait a moment for PHP-FPM to fully start
sleep 2

# Check if PHP-FPM is running
if ! pgrep -x php-fpm > /dev/null; then
    echo "ERROR: PHP-FPM failed to start!"
    exit 1
fi
echo "PHP-FPM started successfully"

# Start Nginx in foreground
echo "Starting Nginx..."
echo "========================================="
echo "Application should be accessible on port $PORT"
echo "========================================="
nginx -g 'daemon off;'
