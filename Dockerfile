FROM php:8.3-apache

# Extensions PHP
RUN apt-get update && apt-get install -y \
    libzip-dev unzip sqlite3 libsqlite3-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip

# Active mod_rewrite
RUN a2enmod rewrite

# Configuration Apache pour Laravel
RUN printf "<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n" \
    > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# Copie du projet
COPY . /var/www/html
WORKDIR /var/www/html

# Permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Clé Laravel
RUN php artisan key:generate --force || true

# Migrations auto
RUN php artisan migrate --force || true

EXPOSE 80
CMD ["apache2-foreground"]

