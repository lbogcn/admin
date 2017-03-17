#!/bin/sh

# 判断session目录是否存在
if [ ! -d "/tmp/lbog.cn/sessions" ]; then
  mkdir -p /tmp/lbog.cn/sessions
fi

php artisan optimize --force
php artisan config:cache
php artisan route:cache
