FROM php:8.3-cli-alpine

RUN apk add --update --no-cache \
        linux-headers \
        acl \
        fcgi \
        file \
        gettext \
        git \
        gnu-libiconv \
        shadow \
        bash

RUN apk add --no-cache \
        $PHPIZE_DEPS \
        icu-dev \
        curl \
        wget \
        git \
        zip \
        unzip

RUN docker-php-ext-install -j$(nproc) \
        intl

RUN docker-php-ext-enable \
        opcache

RUN pecl install xdebug && \
    docker-php-ext-enable \
        xdebug

COPY ./php/ /usr/local/etc/php/

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash -s - --install-dir /usr/local/bin

ARG USER_ID
ARG GROUP_ID
RUN groupadd -g $GROUP_ID user
RUN useradd -u $USER_ID -g $GROUP_ID -m -d /home/user user

WORKDIR /build-a-wall
