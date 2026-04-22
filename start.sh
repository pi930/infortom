#!/bin/sh

# Fix permissions for Render disk
echo "Fixing permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Start PHP-FPM in background
echo "Starting PHP-FPM..."
php-fpm -D

# Wait for database to be ready
echo "Checking database connection..."
until php -r "try { new PDO(getenv('DATABASE_URL')); echo 'DB OK'; } catch (Exception \$e) { exit(1); }"; do
  echo "Database not ready, retrying..."
  sleep 3
done

# Run migrations safely
echo "Running migrations..."
php artisan migrate --force || true

# Start Caddy
echo "Starting Caddy..."
caddy run --config /etc/caddy/Caddyfile
