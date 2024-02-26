# Use a imagem oficial do PHP 8.2
FROM php:8.2

# Instale as extensões necessárias
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    && docker-php-ext-install zip 

RUN pecl install xdebug && docker-php-ext-enable xdebug


RUN docker-php-ext-install xml mbstring 


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/html


COPY . .


RUN composer install


EXPOSE 80


CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]