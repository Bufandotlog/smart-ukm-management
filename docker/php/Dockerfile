FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    shadow

# Configure & Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo_mysql gd fileinfo zip

# Use production php.ini config
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Apply low-resource constraints & performance optimizations
RUN { \
    echo 'memory_limit = 128M'; \
    echo 'upload_max_filesize = 10M'; \
    echo 'post_max_size = 12M'; \
    echo 'max_execution_time = 60'; \
    echo 'opcache.enable = 1'; \
    echo 'opcache.memory_consumption = 32'; \
    echo 'opcache.interned_strings_buffer = 4'; \
    echo 'opcache.max_accelerated_files = 2000'; \
    echo 'opcache.validate_timestamps = 1'; \
    echo 'opcache.revalidate_freq = 2'; \
    } > $PHP_INI_DIR/conf.d/custom.ini

WORKDIR /var/www/html
