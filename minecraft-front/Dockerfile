# build stage
FROM node:18-alpine as build-stage
WORKDIR /home
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# production stage
FROM httpd:2-alpine
COPY --from=build-stage /home/dist/ /usr/local/apache2/htdocs/
