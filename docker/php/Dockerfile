FROM php:8.2-fpm-alpine

# Dependencias del sistema y extensiones PHP que Laravel 10 + PostgreSQL requieren
# (el resto — mbstring, tokenizer, xml, ctype, curl, dom, fileinfo, openssl, pdo, session — ya vienen en la imagen oficial)
RUN apk add --no-cache postgresql-dev libzip-dev git unzip \
    && docker-php-ext-install pdo_pgsql bcmath zip opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# PHP-FPM escucha en 9000; nginx le reenvía los .php
EXPOSE 9000
CMD ["php-fpm"]
