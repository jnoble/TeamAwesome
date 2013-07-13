#!/bin/bash
set +e
PIDFILE=/tmp/beaver.pid

function beaver_status() {
	test -f $PIDFILE || echo "beaver not running" && return 1
	pgrep -P $(cat $PIDFILE) python && echo "beaver running" 
}

function kill_beaver() {
	beaver_status && pkill python -P $(cat $PIDFILE) || return 0
}

function start_beaver() {
	beaver_status || echo "starting beaver" && /usr/local/bin/beaver -f /var/log/nginx/error_log.log /var/log/nginx/access_log.log -F json -P $PIDFILE -t rabbitmq -c /tmp/beaver.ini --fqdn -D
	sleep 1
}


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
diff /vagrant/lb/beaver.ini /tmp/beaver.ini || kill_beaver && cp /vagrant/lb/beaver.ini /tmp/beaver.ini 
start_beaver

