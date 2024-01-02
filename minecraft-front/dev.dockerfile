FROM node:18-alpine

ARG APP_HOME

ENV APP_HOME=${APP_HOME:-'/home'}

RUN npm install -g http-server

WORKDIR $APP_HOME

CMD [ "http-server", "dist", "-p", "80" ]
