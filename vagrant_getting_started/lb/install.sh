#!/bin/sh

. ../common.sh

sudo apt-get install haproxy
sudo dpkg -i /vagrant/nginx-latest.deb
sudo cp /vagrant/lb/haproxy.cfg /etc/haproxy/
sudo /etc/init.d/nginx restart
sudo /etc/init.d/haproxy restart

