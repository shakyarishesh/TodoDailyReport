FROM richarvey/nginx-php-fpm:1.7.2

# Install necessary packages
RUN apt-get update && apt-get install -y \
    curl \
    libzip-dev \
    unzip \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files to the container
COPY . /var/www/html

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

# Start the service
CMD ["/start.sh"]
