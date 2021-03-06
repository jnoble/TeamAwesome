#!/bin/bash

. ../common.sh

sudo apt-get install haproxy logrotate
sudo dpkg -i /vagrant/nginx-latest.deb
sudo crontab -l | grep "logrotate" > /dev/null || sudo crontab /vagrant/lb/logrotate.cron
sudo cp /vagrant/lb/logrotate.d/nginx /etc/logrotate.d/
sudo cp /vagrant/lb/logrotate.d/haproxy /etc/logrotate.d/
sudo dpkg -i /vagrant/nginx-latest.deb
sudo cp /vagrant/lb/haproxy.cfg /etc/haproxy/
sudo cp /vagrant/lb/haproxy /etc/default/haproxy
sudo rm /etc/nginx/*
sudo cp /vagrant/lb/nginx/* /etc/nginx/
sudo cp /vagrant/lb/rsyslog.conf /etc/rsyslog.conf
test -d /opt/logs || sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo /etc/init.d/nginx restart
sudo /etc/init.d/haproxy restart
sudo /etc/init.d/rsyslog restart
diff /vagrant/lb/beaver.ini /tmp/beaver.ini || kill_beaver && cp /vagrant/lb/beaver.ini /tmp/beaver.ini 
start_beaver

