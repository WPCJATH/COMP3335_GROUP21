FROM php:7.4-apache
RUN docker-php-ext-install mysqli pdo_mysql
RUN apt-get update \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip

RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY ./certificate/*.pem /etc/apache2/ssl/
COPY ./conf/www.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
EXPOSE 443

FROM phpmyadmin/phpmyadmin
RUN a2enmod ssl && a2enmod rewrite
RUN mkdir -p /etc/apache2/ssl
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

COPY ./certificate/*.pem /etc/apache2/ssl/
COPY ./conf/www.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
EXPOSE 443