# 项目 composed

PHP development environment

used images: nginx, php, mysql, redis, mongo, node, tarsPHP

PHP extension:
pdo_mysql
mongodb
redis
phalcon 3.4.4
swoole 4.3.4
tarsPHP

# 目录结构
├── app
│   ├── log
│   ├── node
│   │   ├── index.js
│   │   └── package.json
│   ├── tars
│   └── www
│       ├── db_test.php
│       ├── index.html
│       └── phpinfo.php
├── data
├── docker-compose.yml
├── env-example
├── mysql
│   └── conf.d
│       └── custom.cnf
├── nginx
│   └── conf.d
│       └── default.conf
├── php
│   ├── Dockerfile
│   ├── Dockerfile-tars
│   └── php.ini
└── README.md

- 说明
1. /app 隐射到容器里面，存放日志，源码文件
2. /data 是存放 mysql， redis， mongo 等数据库文件
3. /mysql 配置文件

# 使用
- 复制 env-example 为 .env 并按自己的环境替换里面的配置
- 在 /nginx/conf.d/ 增加站点配置
- 根据所需编辑 docker-compose.yml 需要用到的容器组。也可以自己写 Dockerfile进行 自定义build
- 运行命令
```
docker-compose up -d
```