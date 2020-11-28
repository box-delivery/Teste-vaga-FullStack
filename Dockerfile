FROM php:7.4-cli-alpine as buildenv

RUN apk add git

COPY --from=composer:1.9.1 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

COPY . .

RUN composer run-script post-autoload-dump

FROM php:7.4-fpm-alpine

RUN apk add icu-dev
RUN docker-php-ext-install -j$(nproc) bcmath intl opcache mysqli pdo_mysql

RUN apk add nginx supervisor

# php and php-fpm configuration
COPY .build/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY .build/docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY .build/php.ini-production /usr/local/etc/php/php.ini

# Nginx configuration
COPY .build/nginx.conf /etc/nginx/nginx.conf
COPY .build/box-movies.public.conf /etc/nginx/conf.d/default.conf

# Supervisor configuration
COPY .build/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ARG ENV_FILE=.env

WORKDIR /var/www
COPY --chown=www-data:www-data --from=buildenv /var/www .
COPY --chown=www-data:www-data $ENV_FILE .env

EXPOSE 80

ENTRYPOINT [ "supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf", "-n" ]

LABEL maintainer="douglassleite@outlook.com"
LABEL org.label-schema.schema-version="1.0"
LABEL org.label-schema.name="box-movies"
LABEL org.label-schema.vcs-url=""
LABEL org.label-schema.vendor="box-movies"
