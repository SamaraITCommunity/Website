#!/bin/sh
set -e
mkdir -p /app/runtime /app/public/assets
chown -R www-data:www-data /app/runtime /app/public/assets
exec docker-php-entrypoint "$@"
