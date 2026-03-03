FROM php:8.2-apache

# Copy toàn bộ project vào Apache
COPY . /var/www/html/

# Bật extension MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Cho phép rewrite nếu cần
RUN a2enmod rewrite