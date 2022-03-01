FROM php:8.0.1-apache
COPY ./ /var/www/html/
RUN docker-php-ext-install mysqli
CMD ["apache2ctl", "-D", "FOREGROUND"]