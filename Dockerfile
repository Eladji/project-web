FROM php:8-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable mysqli

# Copy application source
COPY ./src /var/www/html

# Ensure the Apache configuration listens on port 80
EXPOSE 80
EXPOSE 8081
EXPOSE 3306