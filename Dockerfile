FROM php:8-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable mysqli