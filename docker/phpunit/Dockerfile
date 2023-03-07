FROM php:8.0-cli

RUN apt-get update && apt-get install -y \
    zip \ 
    unzip

# Composerのインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# ミドルウェアインストール
RUN apt-get update \
&& apt-get install -y \
git \
vim \
default-mysql-client-core \
&& docker-php-ext-install pdo_mysql

WORKDIR /app
SHELL ["/bin/bash", "-c"]
