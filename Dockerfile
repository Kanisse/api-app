FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html
WORKDIR /var/www/html

RUN chmod -R 755 /var/www/html/storage

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader --no-interaction
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000