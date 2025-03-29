FROM php:8.2-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www

COPY composer.json ./

RUN composer require mongodb/mongodb