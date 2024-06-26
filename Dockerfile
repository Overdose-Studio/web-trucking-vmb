# Use the official PHP-FPM Alpine image as the base image
FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www

# Install system dependencies and PHP extensions
RUN apk --no-cache add \
    git \
    curl \
    curl-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd mysqli xml zip curl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents and set permissions
COPY . /var/www
RUN chown -R www-data:www-data /var/www

# Install application dependencies
RUN composer install --no-interaction

# Change current user to www-data
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000

# Default command
CMD ["php-fpm"]
