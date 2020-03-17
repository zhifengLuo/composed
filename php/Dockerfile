FROM php:7.4-fpm

LABEL maintainer="24006765@qq.com"

ENV TZ PRC
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 更新apt-get源
RUN echo "deb http://mirrors.aliyun.com/debian/ buster main non-free contrib \n \
deb-src http://mirrors.aliyun.com/debian/ buster main non-free contrib \n \
deb http://mirrors.aliyun.com/debian-security buster/updates main \n \
deb-src http://mirrors.aliyun.com/debian-security buster/updates main \n \
deb http://mirrors.aliyun.com/debian/ buster-updates main non-free contrib \n \
deb-src http://mirrors.aliyun.com/debian/ buster-updates main non-free contrib \n \
deb http://mirrors.aliyun.com/debian/ buster-backports main non-free contrib \n \
deb-src http://mirrors.aliyun.com/debian/ buster-backports main non-free contrib" > /etc/apt/sources.list

# install ext
RUN apt-get clean && apt-get update && apt-get install -y \
        # apt-utils \
        # build-essential \
        # libmagickcore-dev \
        # libmagickwand-dev \
        # imagemagick \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        # libmcrypt-dev \
        libmemcached-dev \
        && docker-php-ext-install -j$(nproc) gd zip pdo_mysql \
        && pecl install https://pecl.php.net/get/redis-5.2.0.tgz \
        && pecl install memcached \
        && pecl install https://pecl.php.net/get/mongodb-1.7.3.tgz \
        # && pecl install imagick \
        # && pecl install mcrypt \
        && pecl install psr \
        && pecl install phalcon \
        && pecl install https://pecl.php.net/get/swoole-4.4.16.tgz \
        && docker-php-ext-enable redis memcached mongodb psr phalcon swoole

# install composer
RUN curl -sS https://getcomposer.org/installer | php --install-dir=/usr/local/bin --filename=composer

# install xdebug
# ARG INSTALL_XDEBUG=false

# RUN if [ ${INSTALL_XDEBUG} = true ]; then \
#   pecl install xdebug; \
#   docker-php-ext-enable xdebug \
# ;fi
# COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# install phalcon
# ## 方法一
# ARG PHALCON_VERSION=3.4.4
# ARG PHALCON_EXT_PATH=php7/64bits

# RUN set -xe && \
#         # Compile Phalcon
#         curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
#         tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
#         docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} && \
#         # Remove all temp files
#         rm -r \
#             ${PWD}/v${PHALCON_VERSION}.tar.gz \
#             ${PWD}/cphalcon-${PHALCON_VERSION}

## 方法二
# RUN set -xe && \
#         pecl install phalcon && \
#         docker-php-ext-enable phalcon

# # install swoole
# ARG SWOOLE_VERSION=4.3.4
# RUN set -xe && \
#         pecl install swoole-${SWOOLE_VERSION} && \
#         docker-php-ext-enable swoole

# clear
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

COPY startup.sh /root/startup.sh
RUN chmod 755 /root/startup.sh

STOPSIGNAL SIGQUIT

EXPOSE 9000
# CMD ["php-fpm"]
CMD [ "/root/startup.sh"]