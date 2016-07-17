FROM php:7.0.8-apache

ADD apache2.conf /etc/apache2/
ADD 000-default.conf /etc/apache2/sites-available/
ADD php.ini /usr/local/etc/php/

RUN apt-get update
RUN apt-get -y install libicu-dev
RUN docker-php-ext-install pdo_mysql intl

# mod_rewriteを有効にする
RUN a2enmod rewrite