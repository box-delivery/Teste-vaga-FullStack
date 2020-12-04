FROM composer:2 AS composer

FROM php:7.4-cli

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN mkdir /app
WORKDIR /app

COPY composer.json .
COPY composer.lock .

RUN apt-get update
RUN apt-get install git libzip-dev zip -y

RUN docker-php-ext-install zip
RUN composer install --no-autoloader

COPY . .

RUN touch database/database.sqlite

# removes .env if running in dev and copy base .env.example
RUN rm .env -f
RUN cp .env.example .env

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0"]

