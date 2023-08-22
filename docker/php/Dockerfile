FROM php:7.3-fpm

USER root

ARG UID=1000
ARG GID=1000

RUN apt-get update

RUN apt-get install -y git nano \
    zip unzip libicu-dev zlib1g-dev libzip-dev && \
    docker-php-ext-install intl zip

RUN apt-get clean

RUN groupadd -g $GID app && useradd --create-home -u $UID -g $GID app

RUN yes | pecl install xdebug-2.9.8 && \
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > \
    /usr/local/etc/php/conf.d/xdebug.ini

RUN curl -sS https://getcomposer.org/installer | \
    php -- --version=1.10.6 --filename=composer --install-dir=/usr/local/bin

WORKDIR /home/app/code

COPY ./docker/php/php.ini $PHP_INI_DIR/php.ini

