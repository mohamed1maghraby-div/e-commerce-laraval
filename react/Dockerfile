# ======================================================================
# node
FROM node:17-alpine as react

WORKDIR /var/www/react
COPY package.json .

RUN npm install
COPY . .

CMD [ "npm", "run", "dev"]