
# Etapa 1: Obter o Composer
FROM composer:2 AS composer

# Etapa 2: Preparar o PHP com Apache
FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# Copiar os arquivos do projeto
COPY . /var/www/html/

# Copiar o Composer para o container PHP
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Instalar as dependências PHP
RUN composer install --no-dev --optimize-autoloader
