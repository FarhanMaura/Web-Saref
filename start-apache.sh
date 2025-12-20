#!/bin/bash

# Update Apache to listen on Railway's PORT
if [ ! -z "$PORT" ]; then
    sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
    sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf
fi

# Start Apache
exec apache2-foreground
