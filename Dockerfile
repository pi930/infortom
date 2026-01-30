# Utilise PHP 8.3 avec Apache
FROM php:8.3-apache

# Installe les extensions nécessaires à Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip

# Active mod_rewrite pour Laravel
RUN a2enmod rewrite
# Configure Apache pour Laravel
RUN echo "<Directory /var/www/html/public>" \
    "AllowOverride All" \
    "Require all granted" \
    "</Directory>" \
    > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Configure Apache pour pointer vers /var/www/html/public
COPY . /var/www/html
WORKDIR /var/www/html

# Permissions Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installe les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Génère la clé Laravel si absente
RUN php artisan key:generate --force || true

# Exécute les migrations automatiquement (plan Free = pas de Shell)
RUN php artisan migrate --force || true

# Expose le port Apache
EXPOSE 80

# Démarre Apache
CMD ["apache2-foreground"]

