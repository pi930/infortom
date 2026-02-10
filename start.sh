#!/bin/sh

php-fpm -D
php artisan migrate --force
php artisan db:seed --force
caddy run --config /etc/caddy/Caddyfile
