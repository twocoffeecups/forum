FROM node:18

RUN apt-get update && apt-get install -y \
    vim \
    zip \
    unzip \
    curl

USER node

EXPOSE 5173

CMD ["sh", "-c", "npm install && npm run dev -- --host"]
