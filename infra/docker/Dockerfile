FROM php:7.3-apache

RUN apt-get update -yqq \
  && apt-get install -yqq --no-install-recommends \
    git \
    zip \
    unzip \
  && rm -rf /var/lib/apt/lists

RUN docker-php-ext-install pdo_mysql mysqli
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

ENV PATH="${PATH}:/var/www/html/lib/Cake/Console"
ENV PATH="${PATH}:/var/www/html/app/Vendor/bin"

COPY ./infra/docker/apache/site.conf /etc/apache2/sites-available/000-default.conf

COPY . .
WORKDIR ./app

RUN mkdir -p tmp/cache/models tmp/cache/persistent \
  && chown -R :www-data tmp \
  && chmod -R 770 tmp

RUN a2enmod rewrite && service apache2 restart

EXPOSE 80
