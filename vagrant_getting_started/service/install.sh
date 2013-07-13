#!/bin/sh
. ../common.sh

sudo apt-get install php5-fpm
sudo apt-get install php5
sudo apt-get install librabbitmq-dev
sudo dpkg -i /vagrant/nginx-latest.deb
sudo rm /etc/nginx/*
sudo cp /vagrant/service/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo /etc/init.d/nginx restart
diff /vagrant/service/beaver.ini /tmp/beaver.ini || kill_beaver && cp /vagrant/service/beaver.ini /tmp/beaver.ini
start_beaver
