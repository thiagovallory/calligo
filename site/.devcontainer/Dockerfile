FROM mcr.microsoft.com/devcontainers/php:1-7.4-bullseye

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client libicu-dev libzip-dev unzip cron \ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install intl and zip PHP extensions
RUN docker-php-ext-install intl zip

# Install xdebug
# RUN pecl install xdebug-3.0.4 && docker-php-ext-enable xdebug

RUN echo "PHP Modules" && php -r 'echo join("\n", get_loaded_extensions());'

# [Optional] Uncomment this section to install additional OS packages.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <your-package-list-here>

RUN  echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# [Optional] Uncomment this line to install global node packages.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <your-package-here>" 2>&1

# RUN a2enmod rewrite ssl

# COPY etc/cron.d/crontab /etc/cron.d/crontab
# RUN chmod 0644 /etc/cron.d/crontab
# RUN crontab /etc/cron.d/crontab
# RUN touch /var/log/cron.log

# CMD (cron &) && apachectl -D FOREGROUND
