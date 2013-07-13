#!/bin/sh
set +e
sudo apt-get install vim
sudo apt-get install git-core
sudo apt-get install python-pip

/usr/bin/pip freeze | grep -i beaver > /dev/null 2>&1 || sudo /usr/bin/pip install git+git://github.com/josegonzalez/beaver.git#egg=beaver

PIDFILE=/tmp/beaver.pid

function beaver_status() {
        test ! -f $PIDFILE && echo "beaver not running" && return 1
        ps aux | grep $(cat $PIDFILE) | grep python >/dev/null&& echo "beaver running"
}

function kill_beaver() {
        echo "killing beaver"
        beaver_status >/dev/null && kill $(cat $PIDFILE) > /dev/null 2>&1|| return 0
}

function start_beaver() {
        beaver_status || echo "starting beaver" && /usr/local/bin/beaver -F json -P $PIDFILE -t rabbitmq -c /tmp/beaver.ini --fqdn -D
        sleep 1
}
