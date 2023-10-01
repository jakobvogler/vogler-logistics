FROM php:8.0-apache

WORKDIR /var/www/html

COPY htdocs .
COPY Docker.sh /

RUN docker-php-ext-install mysqli

RUN cat /usr/local/etc/php/php.ini-production > /usr/local/etc/php/php.ini

EXPOSE 80

ENTRYPOINT /Docker.sh
