# Use PHP 8.2 FPM as the base image
FROM php:8.2-fpm

# Install necessary packages, including Nginx and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    libzip-dev \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libwebp-dev \
    zlib1g-dev \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install zip gd pdo pdo_mysql mbstring

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Check Composer version
RUN composer --version

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Change ownership of the application files
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

# Copy Nginx configuration
COPY ./nginx/nginx.conf /etc/nginx/nginx.conf

# Expose port 80 for Nginx
EXPOSE 80

# Start PHP-FPM and Nginx
CMD service nginx start && php-fpm
