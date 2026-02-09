FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Installer Caddy
RUN apt-get update && apt-get install -y debian-keyring debian-archive-keyring curl && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/gpg.key' | gpg --dearmor -o /usr/share/keyrings/caddy-stable-archive-keyring.gpg && \
    curl -1sLf 'https://dl.cloudsmith.io/public/caddy/stable/debian.deb.txt' | tee /etc/apt/sources.list.d/caddy-stable.list && \
    apt-get update && apt-get install -y caddy

# Caddyfile
COPY Caddyfile /etc/caddy/Caddyfile

EXPOSE 80
COPY start.sh /start.sh
RUN chmod +x /start.sh
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
CMD ["/start.sh"]

