FROM php:8.3-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git unzip libpq-dev libzip-dev libicu-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_pgsql zip intl mbstring dom \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
COPY docker/php/entrypoint.sh /usr/local/bin/my-square-entrypoint
RUN chmod +x /usr/local/bin/my-square-entrypoint \
    && echo 'clear_env = no' >> /usr/local/etc/php-fpm.d/www.conf
WORKDIR /app
ENTRYPOINT ["my-square-entrypoint"]
CMD ["php-fpm"]
