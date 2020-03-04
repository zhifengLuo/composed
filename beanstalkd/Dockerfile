FROM alpine
LABEL maintainer="Luozf <24006765@qq.com>"

ENV TZ PRC

RUN apk add --no-cache beanstalkd

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

EXPOSE 11300
ENTRYPOINT ["/usr/bin/beanstalkd"]