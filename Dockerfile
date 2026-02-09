FROM php:8.3-fpm

# Extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# IMPORTANT : NE PAS faire config:cache ici
# IMPORTANT : NE PAS faire migrate ici

CMD ["php-fpm"]

