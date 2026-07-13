#!/bin/bash

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations (DB URL already injected by Render)
php artisan migrate --force || true

# Start PHP-FPM in background
php-fpm &

# Start Caddy in foreground (Render needs this)
exec caddy run --config /etc/caddy/Caddyfile

