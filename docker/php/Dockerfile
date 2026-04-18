# Use the official PHP-FPM image (Alpine is smaller and faster)
FROM php:8.4-fpm-alpine

# Install system dependencies
# Install system dependencies
RUN apk add --no-cache \
    curl \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    linux-headers \   
    $PHPIZE_DEPS

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql zip gd mbstring

# Install Xdebug (Essential for Mac developers)
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Install Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
