FROM php:7.3-fpm

LABEL maintainer="24006765@qq.com"

ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# 更新apt-get源
RUN echo \
        deb http://mirrors.aliyun.com/debian/ stretch main non-free contrib \
        deb-src http://mirrors.aliyun.com/debian/ stretch main non-free contrib \
        deb http://mirrors.aliyun.com/debian-security stretch/updates main \
        deb-src http://mirrors.aliyun.com/debian-security stretch/updates main \
        deb http://mirrors.aliyun.com/debian/ stretch-updates main non-free contrib \
        deb-src http://mirrors.aliyun.com/debian/ stretch-updates main non-free contrib \
        deb http://mirrors.aliyun.com/debian/ stretch-backports main non-free contrib \
        deb-src http://mirrors.aliyun.com/debian/ stretch-backports main non-free contrib \
        > /etc/apt/sources.list

# install ext
RUN apt-get update && apt-get install -y \
        apt-utils \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev && \
        docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
        docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
        
RUN apt-get install -y libzip-dev zip unzip && \
        docker-php-ext-configure zip --with-libzip && \
        docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql && \
        pecl install redis && \
        docker-php-ext-enable redis && \
        pecl install mongodb && \
        docker-php-ext-enable mongodb

# install phalcon
ARG PHALCON_VERSION=3.4.4
ARG PHALCON_EXT_PATH=php7/64bits

RUN set -xe && \
        # Compile Phalcon
        curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz && \
        tar xzf ${PWD}/v${PHALCON_VERSION}.tar.gz && \
        docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) ${PWD}/cphalcon-${PHALCON_VERSION}/build/${PHALCON_EXT_PATH} && \
        # Remove all temp files
        rm -r \
            ${PWD}/v${PHALCON_VERSION}.tar.gz \
            ${PWD}/cphalcon-${PHALCON_VERSION}

#COPY docker-phalcon-* /usr/local/bin/

# install swoole
ENV SWOOLE_VERSION=4.3.4

RUN set -xe && \
        pecl install swoole-${SWOOLE_VERSION} && \
        docker-php-ext-enable swoole

RUN set -xe && \
        curl -LO https://github.com/TarsPHP/tars-extension/archive/master.zip && \
        unzip master.zip && \
        cd tars-extension-master && \
        phpize && \
        ./configure && \
        make install && \
        docker-php-ext-enable phptars && \
        rm -rf master.zip tars-extension-master

# clear
RUN apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
    rm /var/log/lastlog /var/log/faillog

CMD ["php-fpm"]

EXPOSE 9000