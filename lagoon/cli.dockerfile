FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

COPY config /app/config
COPY public /app/public
COPY composer.* /app/

ENV WEBROOT=public
ENV PAGER=less
