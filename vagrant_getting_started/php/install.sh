#!/bin/sh
. ../common.sh

sudo apt-get install php5-fpm
sudo apt-get install php5
sudo apt-get install librabbitmq-dev
sudo apt-get install php-pear
sudo apt-get install pkg-config
sudo dpkg -i /vagrant/nginx-latest.deb
sudo rm /etc/nginx/*
sudo cp /vagrant/php/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo /etc/init.d/nginx restart
