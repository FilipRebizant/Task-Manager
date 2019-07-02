FROM node:latest
WORKDIR /var/www

RUN npm install -g gatsby-cli yarn
RUN gatsby telemetry --disable
CMD ["gatsby", "develop", "-H", "0.0.0.0"]