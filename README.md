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
```
├── app
│   ├── db_test.php
│   ├── index.html
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
│       ├── cad.conf
│       ├── default.conf
│       ├── demo.conf
│       ├── designer.conf
│       ├── litku.conf
│       ├── sp.conf
│       └── test.conf
├── php
│   ├── Dockerfile
│   ├── Dockerfile-tars
│   └── php.ini
└── README.md
```

- 说明
1. /app 源码文件
2. /data 是存放 mysql， redis， mongo 等数据库文件
3. /logs 日志存放
4. /mysql 自定义配置文件
5. /php 自定义配置和 Dockerfile

# 使用
- 复制 env-example 为 .env 并按自己的环境替换里面的配置
- 在 /nginx/conf.d/ 增加站点配置, 添加测试域名到 hosts 指向到本地。具体可以参考 demo.conf
- 根据所需编辑 docker-compose.yml 需要用到的容器组。也可以自己写 Dockerfile进行 自定义build
- 运行命令
```
docker-compose up -d
```
访问 demo.local.cn 就可以看到 It‘s ok！