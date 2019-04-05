FROM php:7.3-fpm

RUN pecl install xdebug-2.7.0 \
    && apt-get update && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable xdebug




CMD ["php-fpm"]

