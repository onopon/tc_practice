FROM php:8.4-cli

ADD php.ini /usr/local/etc/php/

RUN apt-get update && apt-get install -y \
    zip \ 
    unzip

# Composerのインストール
RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# ミドルウェアインストール
RUN apt-get update \
&& apt-get install -y \
wget \
git \
vim \
default-mysql-client-core \
autoconf \
automake \
&& docker-php-ext-install pdo_mysql
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug

WORKDIR /src
SHELL ["/bin/bash", "-c"]
