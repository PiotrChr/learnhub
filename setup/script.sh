#!/bin/bash
syncFolder="/srv/www/"
. $syncFolder'/setup/config.sh'

msg "Adding Repositories"
sudo apt-add-repository -y ppa:ondrej/php
sudo apt-add-repository -y ppa:webupd8team/java
sudo apt-get -y update

sudo apt-get -y install apache2 
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password '$mysqlPassword
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password '$mysqlPassword

# PHP & APACHE
msg "Installing PHP and Apache2"
sudo apt-get -y install mysql-server
sudo apt-get -y install ${phpVer}
sudo apt install php libapache2-mod-php
#sudo apt-get -y install libapache2-mod-${phpVer}
sudo apt-get -y install ${phpVer}-mysql
sudo apt-get -y install php-gettext
sudo apt-get -y install ${phpVer}-mbstring
sudo apt-get -y install ${phpVer}-gd
sudo apt-get -y install ${phpVer}-xsl
sudo apt-get -y install ${phpVer}-xmlrpc
sudo apt-get -y install ${phpVer}-tidy
# sudo apt-get -y install ${phpVer}-sqlite3
sudo apt-get -y install ${phpVer}-recode
sudo sudo apt-get -y install ${phpVer}-pspell
sudo apt-get -y install php-memcache
sudo apt-get -y install ${phpVer}-mcrypt
sudo apt-get -y install ${phpVer}-imap
sudo apt-get -y install php-imagick
sudo php5enmod imagick
sudo apt-get -y install php-pear
sudo apt-get -y install ${phpVer}-intl
sudo apt-get -y install ${phpVer}-gd
sudo apt-get -y install ${phpVer}-curl
sudo apt-get -y install php-apcu
sudo a2enmod rewrite
sudo a2enmod php7.0
sudo service apache2 restart
sudo apt-get -y install zip unzip

#Apache virtual host
msg "Setting up virtual host"
sudo cp -rf $syncFolder$sources"000-default.conf" /etc/apache2/sites-available/000-default.conf
sudo cp -rf $syncFolder$sources"apache2.conf" /etc/apache2/apache2.conf


#Symfony Permissions
sudo chmod -R 775 $syncFolder"app/cache"
sudo chmod -R 775 $syncFolder"app/logs"
sudo chmod -R 775 $syncFolder"app/config/parameters.yml"


#Apache permissions
#msg "Fixing permissions"
#sudo su
#usermod -aG www-data vagrant
#chown -R www-data:www-data $syncFolder
#service apache2 restart
#exit

#Composer
msg "Installing Composer"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

#Java
msg "Installing Java"
echo "oracle-java8-installer shared/accepted-oracle-license-v1-1 select true" | sudo debconf-set-selections
sudo apt-get -y install oracle-java8-installer

#TMP Folder
msg "Checking for tmp folder"
if [ ! -d "$tmp" ]; then
	msg "Creating tmp folder"
	mkdir $tmp
fi

# #Server Folder
# if [ ! -d "$tmp" ]; then
# 	mkdir $tmp
# fi


# NPM
# sudo apt-get -y install nodejs
# sudo ln -s `which nodejs` /usr/bin/node

#ElasticSearch
elastic=$tmp$elasticFilename
if [ ! -f "$elastic" ]; then
	wget -Oq $elastic $elasticUrl
fi
sudo dpkg -i $elastic
sudo update-rc.d elasticsearch defaults

msg "Adding Vagrant to elasticsearch group"
sudo usermod -aG elasticsearch vagrant
sudo chgrp elasticsearch '/etc/elasticsearch/'
sudo chown -R vagrant:elasticsearch '/etc/elasticsearch/'

msg "Configuring elasticsearch"
conf=$(cat <<EOF
node.name: "Learnhub"
cluster.name: "learnhub"
index.number_of_shards: 1
index.number_of_replicas: 0
network.bind.host: localhost

EOF
)

echo "$conf" > '/etc/elasticsearch/elasticsearch.yml'
sudo service elasticsearch restart

#Copy Parameters.yml
msg "Creating parameters.yml file for Symfony 3"
sudo cp $syncFolder$sources"/parameters.yml" $syncFolder"/app/config/parameters.yml"

msg "Finished!"
