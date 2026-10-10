#!/bin/bash

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
echo "ENV CHECK:"
env | grep -i database
env | grep -i db

php artisan migrate --force || true

php-fpm -D
exec caddy run --config /etc/caddy/Caddyfile
