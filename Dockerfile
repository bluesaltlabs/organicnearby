
# Dockerfile for Laravel Octane with FrankenPHP
# Based on Laravel Octane and FrankenPHP documentation

FROM dunglas/frankenphp

# Install required PHP extensions for Octane
RUN install-php-extensions \
    pcntl
    # Add other PHP extensions here if needed

# Copy application code
COPY . /app
WORKDIR /app

# Install Composer dependencies (production only)
RUN composer install --optimize-autoloader --no-dev

# Ensure storage and bootstrap/cache are writable
RUN mkdir -p storage/app storage/framework/cache storage/framework/sessions \
    storage/framework/views storage/logs storage/database bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Expose default FrankenPHP/Octane port
EXPOSE 8000

# Start Octane with FrankenPHP
ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
