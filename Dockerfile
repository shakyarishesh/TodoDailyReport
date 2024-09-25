FROM richarvey/nginx-php-fpm:1.7.2

# Switch to a base image that uses PHP 8.2
FROM php:8.2-fpm

# Install necessary packages
RUN apt-get update && apt-get install -y \
curl \
libzip-dev \
unzip \
libpng-dev \
libjpeg-dev \
libwebp-dev \
zlib1g-dev \
&& docker-php-ext-install zip \
&& docker-php-ext-install gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Check Composer version
RUN composer --version

# Set working directory
WORKDIR /var/www/html

# Copy application files to the container
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

# Expose port 80 for Nginx
EXPOSE 80

# Start the service
# CMD ["php-fpm"]
CMD ["/start.sh"]