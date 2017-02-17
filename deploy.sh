#!/bin/sh

php artisan optimize --force
php artisan config:cache
php artisan route:cache
gulp --pordution
