FROM php:7.4-apache
RUN apt-get update && apt-get -y install \
apt-transport-https \
zip \
ca-certificates \
libpq-dev \
libyaml-dev
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
RUN pecl install yaml
COPY --from=composer:2.2.6 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_NO_INTERACTION=1
COPY docker/apache-site.conf /etc/apache2/sites-available/000-default.conf
COPY . .
ENTRYPOINT ["./entrypoint.sh"]
CMD ["apache2-foreground"]