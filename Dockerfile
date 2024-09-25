# Base image for PHP 8.2 with FPM
FROM php:8.2-fpm

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    zlib1g-dev \
    && docker-php-ext-install zip gd pdo pdo_mysql mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files to the container
COPY . .

# Copy the Nginx configuration file from the local directory to the container
COPY nginx.conf /etc/nginx/nginx.conf

# Change ownership of the application files to www-data
RUN chown -R www-data:www-data /var/www/html

# Set environment variables
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader -vvv

# Cache Laravel configuration, routes, and views
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Expose port 80 for Nginx
EXPOSE 80

# Command to start both Nginx and PHP-FPM
CMD service nginx start && php-fpm
