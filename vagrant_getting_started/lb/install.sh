#!/bin/sh

. ../common.sh

sudo apt-get install haproxy
sudo dpkg -i /vagrant/nginx-latest.deb
sudo cp /vagrant/lb/haproxy.cfg /etc/haproxy/
sudo rm /etc/nginx/*
sudo cp /vagrant/service/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo cp /vagrant/lb/haproxy /etc/default/haproxy
sudo /etc/init.d/nginx restart
sudo /etc/init.d/haproxy restart

