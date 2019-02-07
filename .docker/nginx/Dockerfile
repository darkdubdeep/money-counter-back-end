FROM nginx:stable

ARG port

COPY nginx.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/_PORT_/$port/g" /etc/nginx/conf.d/default.conf