#!/bin/sh

php-fpm -D
php artisan migrate --force
caddy run --config /etc/caddy/Caddyfile
