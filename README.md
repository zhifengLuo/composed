# 项目 composed

PHP development environment

used images: tengine, nginx, php, mysql, redis, mongo, node, tarsPHP

PHP extension:
pdo_mysql
mongodb
redis
memcached
phalcon 3.4.4
swoole 4.3.4
tarsPHP
xdebug

# 目录结构
```
├── app
│   ├── db.php
│   ├── index.html
│   ├── index.js
│   └── phpinfo.php
├── data
├── docker-compose.yml
├── env-example
├── logs
├── mysql
│   └── conf.d
│       └── custom.cnf
├── nginx
│   └── conf.d
│       ├── default.conf
│       └── demo.conf
├── tengine
│   ├── Dockerfile
│   ├── nginx.conf
│   └── conf.d
│       ├── default.conf
│       └── demo.conf
├── php
│   ├── Dockerfile
│   ├── Dockerfile-tars
│   └── php.ini
│   └── xdebug.ini
└── README.md
```

- 说明
1. /app 源码文件
2. /data 是存放 mysql， redis， mongo 等数据库文件
3. /logs 日志存放
4. /mysql 自定义配置文件
5. /php 自定义配置和 Dockerfile

# 使用
- 进入 componsed 目录下
- 复制 env-example 为 .env 并按自己的环境替换里面的配置
- 运行 docker-compose up 
- 浏览器访问 demo.local.cn 应该可以看到欢迎页面

# 添加项目和配置
- 在 /nginx/conf.d/ 增加站点配置, 添加 project.conf，可参考 demo.conf
- 在新建 project 目录，位置参考如下： （<font color=red>注：project目录必须与componsed同级</font>）

    ```
    ├── componsed
    ├── tarsData
    ├── framework
    └── project

    ```

# 自定义修改

- 或者根据所需编辑 docker-compose.yml 需要用到的容器组。也可以自己写 Dockerfile进行 自定义build