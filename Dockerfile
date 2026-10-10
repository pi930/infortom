FROM caddy:2 AS caddy-bin
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

COPY . .

COPY --from=caddy-bin /usr/bin/caddy /tmp/caddy-orig
RUN cat /tmp/caddy-orig > /usr/local/bin/caddy && \
    chmod 755 /usr/local/bin/caddy && \
    rm /tmp/caddy-orig

COPY Caddyfile /etc/caddy/Caddyfile

RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html

EXPOSE 10000


COPY start.sh /start.sh
RUN chmod +x /start.sh

ENTRYPOINT ["/start.sh"]
