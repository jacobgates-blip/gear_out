FROM php:8.2-apache

# pdo_mysql isn't enabled in the base php:8.2-apache image by default.
# This is the single most common cause of "Call to undefined function"
# or connection errors in a PHP + MySQL Codespace — installing it here,
# once, at build time, avoids it entirely.
RUN docker-php-ext-install pdo pdo_mysql mysqli
