# Base image
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Set alias
RUN echo "alias pamfs='php artisan migrate:fresh --seed'" >> ~/.bashrc
RUN echo "alias paq='php artisan queue:work'" >> ~/.bashrc
RUN echo "alias paw='php artisan websockets:serve'" >> ~/.bashrc
RUN echo "alias pa='php artisan'" >> ~/.bashrc

# Install dependencies
RUN apt-get update && apt-get install -y \
    procps \
    cron\
    vim \
    nano \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath opcache -j$(nproc) gd

# Install Swoole extensio
RUN pecl install redis swoole \
    && docker-php-ext-enable redis swoole

# Install composer
COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

# Copy source code
COPY . /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage



# Install dependencies
# RUN composer install --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Telescope
# RUN php artisan telescope:install
# RUN php artisan vendor:publish --tag=telescope-migrations

# Expose port
EXPOSE 8100

# Run entrypoint
COPY entrypoint.sh /usr/local/bin/
RUN chmod u+x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

# Start PHP-FPM server
CMD ["php-fpm"]
