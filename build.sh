#!/bin/bash

if [ -d ./vendor ]; then
  echo "Path ./vendor is exists."
  exit
fi

if [ ! -d ../framework/vendor ]; then
  echo "Path ../framework/vendor not exists"
  exit
fi

echo "copy vendor..."
cp -r ../framework/vendor ./vendor

echo "composer dump..."
composer dump

echo "end"