FROM php:7.2-apache

ARG index

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libxslt-dev

RUN apt-get update && \
    apt-get install libldap2-dev -y && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) opcache gd intl pdo_pgsql pdo_mysql zip xsl \
    && docker-php-ext-enable opcache

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
#RUN composer global require "fxp/composer-asset-plugin:1.4.2"

RUN mkdir /var/log/apache/
RUN mkdir /var/www/html/web/

RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf

COPY apache.conf /etc/apache2/sites-available/site.conf

RUN sed -i "s/_INDEX_/$index/g" /etc/apache2/sites-available/site.conf

COPY php.ini /usr/local/etc/php/conf.d/php.ini

RUN a2enmod rewrite \
    && a2ensite site