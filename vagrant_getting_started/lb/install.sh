#!/bin/sh

. ../common.sh

sudo apt-get install haproxy
sudo dpkg -i /vagrant/nginx-latest.deb
sudo cp /vagrant/haproxy.cfg

