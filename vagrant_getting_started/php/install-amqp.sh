cd /tmp
git clone git://github.com/alanxz/rabbitmq-c.git
cd /tmp/rabbitmq-c
git submodule init
git submodule update
sudo autoreconf -i
sudo ./configure
sudo make
sudo make install
sudo pecl install amqp
sudo cp /vagrant/php/amqp.ini /etc/php5/conf.d/amqp.ini
sudo /etc/init.d/php5-fpm restart
