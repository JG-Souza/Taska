# Imagem base oficial do PHP com suporte para Laravel
FROM php:8.2-cli

# Instala extensões e dependências necessárias para o Laravel e o MySQL
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala o Composer (gerenciador de dependências do PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho no container
WORKDIR /var/www

# Expondo a porta onde o Laravel rodará com `php artisan serve`
EXPOSE 8000
