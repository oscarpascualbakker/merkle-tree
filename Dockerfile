FROM php:8.0-apache

RUN apt-get update -y && \
    apt-get upgrade -y && \
    apt-get install -y libmcrypt-dev git zip unzip libzip-dev openssl libicu-dev libonig-dev

RUN docker-php-ext-configure zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure mbstring

RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring

COPY .docker/xdebug/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY . /var/www/html

RUN pecl install redis-5.3.4 && \
    pecl install xdebug-3.0.4 && \
    docker-php-ext-enable redis xdebug

WORKDIR /var/www/html

# Get Composer!
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

RUN composer install