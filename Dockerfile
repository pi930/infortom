FROM php:8.3-apache
ARG CACHE_BREAK=3


# Extensions PHP
RUN apt-get update && apt-get install -y \
    libzip-dev unzip sqlite3 libsqlite3-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite pdo_pgsql zip

# Active mod_rewrite
RUN a2enmod rewrite

# Copie du projet
COPY . /var/www/html
WORKDIR /var/www/html

# Permissions Laravel (IMPORTANT : après le COPY)
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage/ bootstrap/cache/

# VirtualHost
RUN printf "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>\n" \
    > /etc/apache2/sites-available/000-default.conf

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Clé Laravel
RUN php artisan key:generate --force || true

EXPOSE 80
CMD ["apache2-foreground"]
