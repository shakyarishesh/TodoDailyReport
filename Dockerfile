FROM richarvey/nginx-php-fpm:1.7.2

# Copy application files to the container
COPY . /var/www/html

# Set environment variables
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel environment configuration
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Remove SKIP_COMPOSER or set it to 0
# This allows Composer to run during the build process
ENV SKIP_COMPOSER 0

# Install composer dependencies
RUN composer install --no-dev --optimize-autoloader

# Set correct permissions for Laravel folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Cache Laravel configuration, routes, and views
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Start the service
CMD ["/start.sh"]
