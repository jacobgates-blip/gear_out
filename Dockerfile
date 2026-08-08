FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update && apt-get install -y default-mysql-client git && rm -rf /var/lib/apt/lists/*
