#!/bin/bash
set -e

# Set default PORT if not provided
export PORT=${PORT:-8080}

echo "Starting services on PORT: $PORT"

# Replace PORT placeholder in nginx config
envsubst '${PORT}' < /etc/nginx/sites-available/default > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/sites-available/default

# Test nginx configuration
nginx -t

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "Starting Nginx..."
nginx -g 'daemon off;'
