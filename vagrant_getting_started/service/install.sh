#!/bin/sh
. ../common.sh

sudo apt-get install php5-fpm
sudo apt-get install php5
sudo dpkg -i /vagrant/nginx-latest.deb
sudo rm /etc/nginx/*
sudo cp /vagrant/service/nginx/* /etc/nginx/
sudo /etc/init.d/nginx restart
