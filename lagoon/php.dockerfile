ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} as builder

FROM uselagoon/php-8.3-fpm:latest

# Typo3 requires cgi.fix_pathinfo=0 so we set that here
COPY lagoon/01-lagoon-typo3.ini "$PHP_INI_DIR/conf.d/"

COPY --from=builder /app /app
