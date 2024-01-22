FROM node:18-alpine

ARG APP_HOME

ENV APP_HOME=${APP_HOME:-'/home'}

WORKDIR $APP_HOME

CMD npm install && npm run dev
