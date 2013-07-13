#!/bin/sh

. ../common.sh

sudo apt-get install haproxy logrotate python-pip
sudo dpkg -i /vagrant/nginx-latest.deb
/usr/bin/pip freeze | grep -i beaver > /dev/null 2>&1 || sudo /usr/bin/pip install git+git://github.com/josegonzalez/beaver.git#egg=beaver
sudo crontab -l | grep "logrotate" > /dev/null || sudo crontab /vagrant/lb/logrotate.cron
sudo cp /vagrant/lb/logrotate.d/nginx /etc/logrotate.d/
sudo cp /vagrant/lb/haproxy.cfg /etc/haproxy/
sudo rm /etc/nginx/*
sudo cp /vagrant/lb/nginx/* /etc/nginx/
test -d /opt/logs ||  sudo mkdir /opt/logs
test -d /var/log/nginx || sudo mkdir /var/log/nginx
test -d /var/www || sudo mkdir /var/www
sudo chown -R www-data /var/www
sudo cp /vagrant/lb/haproxy /etc/default/haproxy
sudo /etc/init.d/nginx restart
sudo /etc/init.d/haproxy restart
touch /tmp/beaver.pid
diff /vagrant/lb/beaver.ini /tmp/beaver.ini || pkill python -P $(cat /tmp/beaver.pid) && cp /vagrant/lb/beaver.ini /tmp/beaver.ini 
test -f /tmp/beaver.pid && \
pgrep -P $(cat /tmp/beaver.pid) python > /dev/null || /usr/local/bin/beaver -f /var/log/nginx/error_log.log /var/log/nginx/access_log.log -F json -P /tmp/beaver.pid -t rabbitmq -c /tmp/beaver.ini --fqdn -D

