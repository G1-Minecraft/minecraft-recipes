#base php image
FROM php:8.2-apache
RUN apt-get update && apt-get upgrade -y && apt-get install -y unzip libzip-dev
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo pdo_mysql

#args
ARG APP_HOME
ARG DATABASE_USER=root
ARG DATABASE_PASSWORD=changeme
ARG DATABASE_HOST=database
ARG DATABASE_PORT=3306
ARG DATABASE_DB=mysql

#envs
ENV APP_HOME=${APP_HOME:-'/home'}
ENV DATABASE_URL "mysql://$DATABASE_USER:$DATABASE_PASSWORD@$DATABASE_HOST:$DATABASE_PORT/$DATABASE_DB?serverVersion=mariadb-10.11.5"
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV APP_ENV prod

#apache config
RUN sed -ri -e 's!/var/www/html!${APP_HOME}/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APP_HOME}/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

#php.ini setup
RUN sed -ri -e 's!;extension=sodium!extension=sodium!g' /usr/local/etc/php/php.ini*

#project files setup
WORKDIR $APP_HOME
COPY . .

#composer setup
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer
RUN composer install --no-interaction --prefer-dist --no-dev --optimize-autoloader

CMD php bin/console lexik:jwt:generate-keypair & apache2-foreground
