FROM redis

LABEL maintainer="24006765@qq.com"

ENV TZ PRC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

CMD ["redis-server"]