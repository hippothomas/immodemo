ARG VERSION

# Install frontend dependencies and build JS and CSS
FROM node:alpine as npm

WORKDIR /app

COPY ./package.json /app/
COPY ./package-lock.json /app/

RUN npm install

COPY ./webpack.config.js /app/
COPY ./assets /app/assets/

RUN mkdir -p /app/public/build && npm run build

### Build Image Nginx ###
FROM nginx:${VERSION}-alpine as nginx

# Copy nginx config
COPY ./deployment/nginx.conf /etc/nginx/conf.d/default.conf

# Copy assets
COPY ./public/ /app/public/
COPY --from=npm /app/public/build/ /app/public/build/

### Build Image PHP-FPM ###
FROM php:${VERSION}-fpm-alpine AS php-fpm

## Install system dependencies
RUN apk update && \
    apk add --no-cache --virtual dev-deps git && \
    apk add --no-cache zlib-dev libzip-dev

## Install php extensions
RUN apk add libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip

## Copy php default configuration
COPY ./deployment/php.ini /usr/local/etc/php/conf.d/default.ini

ENV APP_ENV=prod
WORKDIR /app

## Install composer
RUN wget https://getcomposer.org/installer && \
    php installer --install-dir=/usr/local/bin/ --filename=composer && \
    rm installer

## Copy project files to workdir
COPY . .
COPY --from=npm /app/public/build/ /app/public/build/

## Install application dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

## Change files owner to php-fpm default user
RUN chown -R www-data:www-data .

## Cleanup
RUN apk del dev-deps && \
    rm /usr/local/bin/composer