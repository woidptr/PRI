FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    zip \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www

COPY composer.json ./

#RUN pecl install mongodb && \
#    docker-php-ext-enable mongodb

RUN composer install