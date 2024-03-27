FROM php:8.2-fpm

WORKDIR /var/www/yii

RUN apt-get update && apt-get upgrade
RUN apt install -q -y libpq-dev libmagickwand-dev zlib1g-dev libpng-dev libjpeg-dev
RUN docker-php-ext-install pdo_pgsql pgsql
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN apt install imagemagick -y
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install gd

