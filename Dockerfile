# Usar una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql mbstring
# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establecer límite de memoria para Composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . .

# Cambiar permisos para Laravel antes de instalar dependencias
RUN chown -R www-data:www-data /var/www/html

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader --verbose

# Establecer permisos finales para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar el servidor
CMD ["apache2-foreground"]
