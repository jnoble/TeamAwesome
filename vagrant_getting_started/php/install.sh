#!/bin/bash
. ../common.sh

sudo apt-get install php5-fpm
sudo apt-get install php5
sudo apt-get install php-pear
sudo apt-get install pkg-config
sudo apt-get install logrotate
sudo crontab -l | grep "logrotate" > /dev/null || sudo crontab /vagrant/php/logrotate.cron
sudo cp /vagrant/php/logrotate.d/nginx /etc/logrotate.d/
sudo dpkg -i /vagrant/nginx-latest.deb
sudo rm /etc/nginx/*
sudo cp /vagrant/php/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo /etc/init.d/nginx restart
diff /vagrant/php/beaver.ini /tmp/beaver.ini || kill_beaver && cp /vagrant/php/beaver.ini /tmp/beaver.ini
start_beaver
