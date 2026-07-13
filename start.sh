#!/bin/bash

# Fix permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start PHP-FPM
php-fpm


# Start Caddy in background
caddy run --config /etc/caddy/Caddyfile &

# Wait for DATABASE_URL to exist
while [ -z "$DATABASE_URL" ]; do
    echo "Waiting for Render to inject DATABASE_URL..."
    sleep 1
done

echo "DATABASE_URL detected: $DATABASE_URL"

# Wait for database
until pg_isready -d "$DATABASE_URL"; do
    echo "Database not ready, retrying..."
    sleep 2
done

echo "Database is ready!"
wait
