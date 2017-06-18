#!/bin/sh
# 所有目标机器都部署完毕之后，做一些清理工作，如删除缓存、平滑重载/重启服务（nginx、php、task）

composer dump
php artisan optimize --force
php artisan config:cache
php artisan route:cache

sudo /etc/init.d/php-fpm restart