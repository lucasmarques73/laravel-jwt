FROM php:7.2-fpm

LABEL maintainer 'Lucas Marques <lucasmarques73@hotmail.com>'

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    zlib1g-dev \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-install \
    intl \
    mbstring \
    pcntl \
    pdo \
    pdo_pgsql \
    pgsql \
    zip \
    opcache

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000