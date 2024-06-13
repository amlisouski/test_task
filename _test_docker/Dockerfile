FROM php:8.1-apache

MAINTAINER Andrzej Lisowski

RUN apt-get update \
    && apt-get -y upgrade

RUN apt-get -y install curl \
    software-properties-common \
    dirmngr \
    gnupg2

RUN apt-get update \
    && apt-get -y install vim \
    nano \
    wget \
    git \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    freetype* \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libonig-dev \
    libmcrypt-dev

RUN apt-get update \
    && apt-get install -y zlib1g-dev

RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql


RUN docker-php-ext-install mbstring

RUN a2enmod rewrite

COPY test.conf /etc/apache2/sites-available/test.conf


RUN a2ensite test.conf

RUN a2enmod headers
RUN a2enmod include
RUN a2enmod ssl

COPY certs/test.crt /etc/ssl/certs/apache-selfsigned.crt
COPY certs/test.key /etc/ssl/private/apache-selfsigned.key

RUN service apache2 start

EXPOSE 80 443