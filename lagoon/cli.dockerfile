FROM lagoon/php-8.3-cli:latest

COPY composer.* /app/
RUN composer install --no-dev --prefer-dist

COPY config /app/config
COPY public /app/public
COPY composer.* /app

RUN sed -i "s/return !empty(ini_get('cgi.fix_pathinfo\'))/return true/g" /app/vendor/typo3/cms-core/Classes/Core/Environment.php

ENV WEBROOT=public
ENV PAGER=less
