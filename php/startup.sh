#!/bin/bash

time=$(date "+%Y-%m-%d %H:%M:%S")
echo "startup ${time}" >> /root/startup.log 2>&1  &

php-fpm