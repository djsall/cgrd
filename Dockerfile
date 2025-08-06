FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

COPY ../public/ /var/www/html/
COPY src/ /var/www/html/src/
COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y unzip \
&& curl -sS https://getcomposer.org/installer | php \
&& mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/


