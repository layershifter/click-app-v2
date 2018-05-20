FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libicu-dev zip unzip
RUN docker-php-ext-install intl opcache pdo pdo_mysql
RUN docker-php-ext-enable intl opcache

RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

RUN usermod -u 1000 www-data
