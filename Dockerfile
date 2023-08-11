FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y wget git unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    wget https://phar.phpunit.de/phpunit-9.5.phar -O /usr/local/bin/phpunit && \
    chmod +x /usr/local/bin/phpunit && \
    docker-php-ext-install pdo_mysql

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install

EXPOSE 9000

CMD ["php-fpm"]