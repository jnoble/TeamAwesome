#!/bin/bash
. ../common.sh

sudo apt-get -q -y install php5-fpm
sudo apt-get -q -y install php5
sudo apt-get -q -y install php5-mysql
sudo apt-get -q -y install php5-curl
sudo apt-get -q -y install logrotate
export DEBIAN_FRONTEND=noninteractive
sudo apt-get -q -y install mysql-server
sudo dpkg -i /vagrant/nginx-latest.deb
sudo crontab -l | grep "logrotate" > /dev/null || sudo crontab /vagrant/service/logrotate.cron
sudo cp /vagrant/service/logrotate.d/nginx /etc/logrotate.d/
sudo cp -r /vagrant/service/php_extensions/* /etc/php5/conf.d/
sudo rm /etc/nginx/*
sudo cp /vagrant/service/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo /etc/init.d/nginx restart
sudo /etc/init.d/php5-fpm restart
diff /vagrant/service/beaver.ini /tmp/beaver.ini || kill_beaver && cp /vagrant/service/beaver.ini /tmp/beaver.ini
start_beaver
