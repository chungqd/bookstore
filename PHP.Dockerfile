FROM php:7.1-fpm

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# make sure apt is up to date
RUN apt-get update --fix-missing
RUN apt-get install -y curl
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN apt-get -y install gcc make autoconf libc-dev pkg-config
RUN apt-get -y install libmcrypt-dev

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH      $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

WORKDIR /var/www/html

RUN pecl config-set php_ini "${PHP_INI_DIR}/php.ini"
RUN pecl install mcrypt-1.0.0 \
    && docker-php-ext-enable mcrypt;

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN usermod -u 1000 www-data