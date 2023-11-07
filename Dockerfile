# Use the official PHP image with PHP-FPM
FROM php:8.1-fpm

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        unzip \
        git \
        supervisor \
    && docker-php-ext-install pdo_mysql zip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy your Laravel application into the container
COPY . /var/www/html

# Set environment variables
ENV APP_NAME=Laravel
ENV APP_ENV=local
ENV APP_KEY="base64:z1xmmFMhnA+jZunDqxJBeEDQirtyeMRw7c5yhytgIHo="
ENV APP_DEBUG=true
ENV APP_URL=http://localhost

ENV LOG_CHANNEL=stack
ENV LOG_DEPRECATIONS_CHANNEL=null
ENV LOG_LEVEL=debug

ENV BROADCAST_DRIVER=log
ENV CACHE_DRIVER=file
ENV FILESYSTEM_DISK=local
ENV QUEUE_CONNECTION=sync
ENV SESSION_DRIVER=file
ENV SESSION_LIFETIME=120

ENV MEMCACHED_HOST=127.0.0.1

ENV REDIS_HOST=127.0.0.1
ENV REDIS_PASSWORD=null
ENV REDIS_PORT=6379




# Install Laravel dependencies using Composer
RUN composer install

# Set proper permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
