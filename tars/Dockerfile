FROM centos/systemd

WORKDIR /root/

##修改镜像时区 
ENV TZ=Asia/Shanghai
	
ENV DBIP 127.0.0.1
ENV DBPort 3306
ENV DBUser root
ENV DBPassword password

# Mysql里tars用户的密码，缺省为tars2015
ENV DBTarsPass tars2015

COPY --from=tarscloud/tars:dev /usr/local/app /usr/local/app
COPY --from=tarscloud/tars:dev /usr/local/tars /usr/local/tars
COPY --from=tarscloud/tars:dev /home/tarsproto /home/tarsproto

RUN yum -y --setopt=tsflags=nodocs update && \
    yum -y --setopt=tsflags=nodocs --nogpgcheck install epel-release deltarpm && \
    yum -y --setopt=tsflags=nodocs --nogpgcheck install https://repo.mysql.com/yum/mysql-8.0-community/el/7/x86_64/mysql80-community-release-el7-1.noarch.rpm && \
    # rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-CentOS-7 && \
	yum -y --setopt=tsflags=nodocs --nogpgcheck install mysql iproute which flex bison protobuf zlib glibc-common make unzip && \
	ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
	localedef -c -f UTF-8 -i zh_CN zh_CN.utf8 && \
	mkdir -p /usr/local/mysql && ln -s /usr/lib64/mysql /usr/local/mysql/lib && ln -s /usr/include/mysql /usr/local/mysql/include && echo "/usr/local/mysql/lib/" >> /etc/ld.so.conf && ldconfig && \
	cd /usr/local/mysql/lib/ && ln -s libmysqlclient.so.*.*.* libmysqlclient.a && \
    rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm && \
    yum -y --setopt=tsflags=nodocs --nogpgcheck --enablerepo=remi-php73 install php-cli \ 
        php-devel \
        php-fpm \
        php-xml \
        php-soap \
        php-xmlrpc \
        php-mbstring \
        php-json \
        php-gd \
        php-mcrypt \
        php-mysqlnd \
        php-pdo \
        php-pecl-mongodb \
        php-pecl-swoole4 \
        php-pecl-xdebug \
        php-pecl-memcached \
        php-pecl-redis5 \
        php-pecl-zip \
        php-phalcon3 && \
	yum clean all && rm -rf /var/cache/yum && \
    mkdir /run/php-fpm

# install tars
RUN set -xe && \
        curl -LO https://github.com/TarsPHP/tars-extension/archive/master.zip && \
        unzip master.zip && \
        cd tars-extension-master && \
        phpize && \
        ./configure && \
        make install && \
        echo "extension = phptars" > /etc/php.d/50-phptars.ini && \
        cd .. && \
        rm -rf master.zip tars-extension-master

# install composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# 是否将Tars系统进程的data目录挂载到外部存储，缺省为false以支持windows下使用
ENV MOUNT_DATA false

# 网络接口名称，如果运行时使用 --net=host，宿主机网卡接口可能不叫 eth0
ENV INET_NAME eth0

# 中文字符集支持
ENV LC_ALL "zh_CN.UTF-8"

VOLUME ["/data"]
	
##拷贝资源
COPY install.sh /root/init/
COPY entrypoint.sh /sbin/
COPY xdebug.ini /etc/php.d/50-xdebug.ini

RUN rm /etc/php-fpm.d/www.conf
ADD www.conf /etc/php-fpm.d/

RUN chmod 755 /sbin/entrypoint.sh

EXPOSE 9000

ENTRYPOINT [ "/sbin/entrypoint.sh", "start" ]

# CMD ["/usr/sbin/php-fpm", "-F"]

