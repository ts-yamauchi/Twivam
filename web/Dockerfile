FROM php:7.0.8-apache

ADD apache2.conf /etc/apache2/
ADD php.ini /usr/local/etc/php/

RUN apt-get update
RUN docker-php-ext-install pdo_mysql