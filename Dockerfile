# Utiliza la imagen oficial de PHP con Apache
FROM php:7.4-apache

# Copia los archivos del proyecto al directorio de trabajo del contenedor
COPY . /var/www/html/

# Instala las extensiones PHP necesarias (puedes ajustar esto según las necesidades de tu proyecto)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configuración adicional de Apache (puedes ajustar esto según las necesidades de tu proyecto)
RUN a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/

# Puerto en el que Apache escuchará (puedes cambiar esto según tus necesidades)
EXPOSE 80

# Comando para iniciar Apache al ejecutar el contenedor
CMD ["apache2-foreground"]