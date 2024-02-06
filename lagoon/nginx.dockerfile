ARG CLI_IMAGE
FROM ${CLI_IMAGE:-builder} as builder

FROM uselagoon/nginx:latest
COPY lagoon/nginx/nginx.conf /etc/nginx/conf.d/app.conf

COPY --from=builder /app /app

ENV WEBROOT=web
