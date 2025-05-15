FROM php:8.2-apache

# RUN apt-get update && apt-get install -y \
#     libzip-dev \
#     unzip \
#     zip \
#     && docker-php-ext-install zip \
#     && docker-php-ext-enable zip

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libicu-dev libonig-dev libxml2-dev libssl-dev pkg-config

RUN pecl install mongodb && docker-php-ext-enable mongodb

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json ./

RUN composer install
RUN composer dump-autoload