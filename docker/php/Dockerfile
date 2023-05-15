FROM php:8.1.18-fpm-bullseye

RUN apt-get update && apt-get install -y curl git zip

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-enable xdebug

ADD config/docker-php-ext-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

