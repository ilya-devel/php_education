FROM php:8.2-fpm

# COPY ./php.ini /usr/local/etc/php/conf.d/php-custom.ini
RUN /bin/sh -c docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN /bin/sh -c pecl install -o -f xdebug && docker-php-ext-enable xdebug

WORKDIR /data

VOLUME /data

CMD ["php-fpm"]