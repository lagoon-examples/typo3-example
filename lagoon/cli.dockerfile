FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

RUN DOWNLOAD_PATH=$(curl -sL "https://api.github.com/repos/uselagoon/lagoon-sync/releases/latest" | grep "browser_download_url" | cut -d \" -f 4 | grep linux_amd64) \
    && wget -O /usr/local/bin/lagoon-sync $DOWNLOAD_PATH && chmod a+x /usr/local/bin/lagoon-sync
    
COPY config /app/config
COPY public /app/public
COPY composer.* .lagoon.yml /app/

ENV WEBROOT=public
ENV PAGER=less
