#!/bin/sh
set -e

echo "Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

echo "Starting PHP-FPM..."
php-fpm -D

echo "Waiting for database..."
until pg_isready -d "$DATABASE_URL"; do
  echo "Database not ready, retrying..."
  sleep 3
done

echo "Database is ready!"

echo "Running migrations..."
php artisan migrate --force || true

echo "Starting Caddy..."
caddy run --config /etc/caddy/Caddyfile
