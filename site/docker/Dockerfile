FROM php:7.4-apache

RUN apt-get update \
    && apt-get install -y libicu-dev libzip-dev unzip cron
RUN docker-php-ext-install intl mysqli pdo pdo_mysql zip

RUN pecl install xdebug-3.0.4\
    && docker-php-ext-enable xdebug

RUN  echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
     && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN a2enmod rewrite ssl

COPY etc/cron.d/crontab /etc/cron.d/crontab
RUN chmod 0644 /etc/cron.d/crontab
RUN crontab /etc/cron.d/crontab
RUN touch /var/log/cron.log

CMD (cron &) && apachectl -D FOREGROUND
