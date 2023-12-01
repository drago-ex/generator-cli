# image from docker hub
FROM php:8.3-apache
MAINTAINER Zdeněk Papučík <zdenek.papucik@gmail.com>

# build-time customization
ARG DEBIAN_FRONTEND=noninteractive

# run commands
RUN apt update && apt upgrade -y

# php extensions
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-enable mysqli

# add files to tmp
ADD docker/oracle/oracle-instantclient12.2-basic_12.2.0.1.0-2_amd64.deb /tmp
ADD docker/oracle/oracle-instantclient12.2-devel_12.2.0.1.0-2_amd64.deb /tmp
ADD docker/oracle/oracle-instantclient12.2-sqlplus_12.2.0.1.0-2_amd64.deb /tmp

# install client
RUN dpkg -i /tmp/oracle-instantclient12.2-basic_12.2.0.1.0-2_amd64.deb
RUN dpkg -i /tmp/oracle-instantclient12.2-devel_12.2.0.1.0-2_amd64.deb
RUN dpkg -i /tmp/oracle-instantclient12.2-sqlplus_12.2.0.1.0-2_amd64.deb

# remove files from tmp
RUN rm -rf /tmp/oracle-instantclient12.2-*.deb

# oracle environment
ENV LD_LIBRARY_PATH /usr/lib/oracle/12.2/client64/lib/
ENV ORACLE_HOME /usr/lib/oracle/12.2/client64/lib/

# configure for php
RUN echo 'instantclient,/usr/lib/oracle/12.2/client64/lib' | pecl install oci8-3.3.0 && docker-php-ext-enable oci8

# the ports
EXPOSE 80
