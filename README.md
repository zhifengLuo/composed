# 项目 composed

PHP development environment

used images: tengine, php, mysql, redis, mongo, node, tarsPHP

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
├── php_tars
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
5. /php_tars 自定义配置和 Dockerfile

    ...

# 使用
- 新建 tarsData, tarsDate_node 两个目录用于挂载tars主控，节点的对应的文件
- 进入 componsed 目录下
- 复制 env-example 并重命名为 .env
- 运行 docker-compose up 
- 浏览器访问 http://localhost 应该可以看到欢迎页面

# 添加项目和配置
1. 在 /nginx/conf.d/ 下添加 project.conf，具体内容参考 demo.conf
2. 新建 project 目录，位置参考如下 （<font color=red>注：project目录必须与componsed同级</font>）

    ```
    ├── componsed
    ├── tarsData
    ├── tarsData_node
    ├── framework
    └── project

    ```
3. 目录指向到 project
   宿主机的目录 /d/docker/project, 对应容器里面的目录是 /app/project, 所以 project.conf 里配置是 “root /app/project;”
4. 运行 docker restart ltengine 重启容器
5. 访问 project.conf 配置的域名，看看是否可以正常访问到

# 其他说明
- PHP CLI 需要进入到 php 容器里面运行
- 容器 tengine 和 redis 这两个是基于 alpine 镜像底层编译的，没有安装 bash，可以使用 sh 代替，如 docker exec -it ltengine sh
- 根据所需编辑 docker-compose.yml 需要用到的容器组。也可以自己写 Dockerfile进行 自定义build