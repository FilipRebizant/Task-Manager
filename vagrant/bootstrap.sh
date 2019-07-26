apt-get update

apt-get upgrade

# Install git
apt-get install -y git

# Install nginx
apt-get install -y nginx
service nginx start

# Add PHP repository
LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php
apt-get update

# Install PHP
apt-get install -y php7.3-fpm

# Install PHP Extensions
apt-get install -y php7.3-mysql php7.3-cli php7.3-curl php7.3-dom

# Install MySQL
apt-get install -y mysql-server

# Install npm
apt-get install -y npm

# Set MySQL password
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

# Setup nginx config
rm /etc/nginx/sites-available/default
rm /etc/nginx/sites-enabled/default
ln -s /var/www/html/vagrant/nginx/default.conf /etc/nginx/sites-available/default
ln -s /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

service nginx restart

# Install Composer
curl -Ss https://getcomposer.org/installer | php
mv composer.phar /usr/bin/composer

# Install backend dependencies
cd /var/www/html/BackEnd
composer install

# Install frontend dependencies
cd /var/www/html/FrontEnd
npm install
