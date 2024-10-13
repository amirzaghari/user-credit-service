FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    zip \
    libsodium-dev \
    && docker-php-ext-install sodium

WORKDIR /var/www

COPY . .

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


