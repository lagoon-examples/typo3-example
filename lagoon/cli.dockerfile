FROM uselagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

RUN architecture=$(case $(uname -m) in x86_64 | amd64) echo "amd64" ;; aarch64 | arm64 | armv8) echo "arm64" ;; *) echo "amd64" ;; esac) \
    && DOWNLOAD_PATH=$(curl -sL "https://api.github.com/repos/uselagoon/lagoon-sync/releases/latest" | grep "browser_download_url" | cut -d \" -f 4 | grep linux_$architecture) \
    && wget -O /usr/local/bin/lagoon-sync $DOWNLOAD_PATH && chmod a+x /usr/local/bin/lagoon-sync
    
COPY config /app/config
COPY public /app/public
COPY composer.* .lagoon.yml .lagoon.env /app/

ENV WEBROOT=public
ENV PAGER=less
