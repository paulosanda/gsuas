FROM php:8.0-fpm

RUN apt-get update && \
    apt-get install -y wget && \
    wget https://phar.phpunit.de/phpunit-9.5.phar -O /usr/local/bin/phpunit && \
    chmod +x /usr/local/bin/phpunit && \
    docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

