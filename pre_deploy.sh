#!/bin/sh
# 在部署代码之前的准备工作，如git的一些前置检查、vendor的安装（更新）

cp -r /home/www/deploy/prod/framework/vendor ./vendor
cp -r /home/www/deploy/prod/framework/BaseComponents/* ./app/Components/Base
