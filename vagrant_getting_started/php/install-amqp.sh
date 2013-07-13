cd /tmp
sudo rm -r /tmp/rabbitmq-c
git clone git://github.com/alanxz/rabbitmq-c.git
cd /tmp/rabbitmq-c
git submodule init
git submodule update
git checkout tags/rabbitmq-c-v0.3.0
sudo autoreconf -i
sudo ./configure
sudo make
sudo make install
sudo pecl uninstall amqp
sudo pecl install amqp
sudo cp /vagrant/amqp.ini /etc/php5/conf.d/amqp.ini
sudo /etc/init.d/php5-fpm restart
