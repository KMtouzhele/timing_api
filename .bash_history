sudo apt upgrade
sudo apt install apache2
sudo chmod -R 777 /var/www/html
cd /var .www.html
ls
cd /var/www/html
ls
sudo nano /etc/apache2/ports.conf
sudo nano /etc/apache2/sites-enabled/000-default.conf
sudo systemctl restart apache2
sudo apt install php libapache2-mod-php php-mysql
sudo apt install mysql-server
sudo systemctl start mysql.service
sudo mysql
sudo mysql_secure_installation
mysql -u root -p
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
sudo phpenmod mbstring
sudo systemctl restart apache2
sudo apt upgrade
sudo apt update
sudo apt upgrade
sudo apt install postfix
sudo nano /etc/postfix/main.cf
sudo systemctl restart postfix
sudo apt install mailutils
echo "title" | mail -s "body" kilmerau@hotmail.com
echo "title" | mail -s "body"
echo "title" | mail -s "body" kilmerlee94@gmail.com
sudo apt install postfix
sudo nano /etc/postfix/main.cf
sudo systemctl restart postfix
sudo apt install mailutils
echo "title" | mail -s "body" kilmerlee94@gmail.com
echo "title" | mail -s "body" picodfh@skiff.com
echo "This is the body of the email" | mail -s "This is the subject line" picodfh@skiff.com
cd ../
ls
cd log
ls
nano mail.log 
ls
cd ../
ls
cd log
nano mail.log 
git version
cd /var/www
ls
cd html
ls
cd tutorial2
ls
git clone https://github.com/lfwells/kit214-tutorial2-mvc-1
ls
cd kit214-tutorial2-mvc-1/
ls
sudo add-apt-repository ppa:vbernat/haproxy-2.0
sudo apt update
sudo apt install haproxy
haproxy -v
sudo chmod 777 /etc/haproxy/haproxy.cfg
sudo nano /etc/haproxy/haproxy.cfg
haproxy -v
sudo chmod 777 /etc/haproxy/haproxy.cfg
sudo nano /etc/haproxy/haproxy.cfg
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service haproxy restart
systemctl status haproxy.service
sudo haproxy -c -f /etc/haproxy/haproxy.cfg
sudo journalctl -xe
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service apache2 stop
sudo service haproxy restart
haproxy -v
sudo service haproxy restart
sudo systemctl restart apache2
sudo chmod 777 /etc/haproxy/haproxy.cfg
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo service apache2 stop
sudo service haproxy restart
sudo service apache2 stop
sudo add-apt-repository ppa:vbernat/haproxy-2.0
sudo apt update
haproxy -v
sudo service haproxy restart
haproxy -v
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo nano /etc/haproxy/haproxy.cfg
sudo service apache2 status
sudo service haproxy status
sudo nano /etc/haproxy/haproxy.cfg
cd var/www/html/tutorial
cd ../
ls
cd var/www/html/
ls
sudo touch square.php
nano square.php 
chmod -777 square.php 
sudo chmod -777 square.php 
sudo nano square.php 
sudo chmod -R 777 /var/www/html 
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo chmod 777 /etc/haproxy/haproxy.cfg
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo chmod -777 square.php 
sudo nano /etc/haproxy/haproxy.cfg
sudo nano /etc/haproxy/haproxy.cfg
sudo service haproxy restart
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo nano /etc/haproxy/haproxy.cfg
haproxy -c -V -f /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo service apache2 stop
sudo service haproxy restart
sudo nano /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo nano /etc/haproxy/haproxy.cfg
sudo service haproxy restart
sudo service apache2 stop
sudo service haproxy restart
sudo service haproxy status
sudo systemctl disable haproxy
sudo systemctl stop haproxy
sudo systemctl start apache2
cd /etc/apache2
ls sites-enabled
ls sites-available
sudo cp /etc/apache2/sites-available/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
sudo rm /etc/apache2/sites-enabled/000-default.conf
sudo nano /etc/apache2/sites-enabled/default-ssl.conf
sudo nano /etc/apache2/ports.conf
sudo service apache2 restart
mkdir /var/www/html/tute4
cd /var/www/html/tute4
openssl genrsa -aes256 -out private.pem 8912
sudo chmod 777 private.pem
openssl rsa -in private.pem -pubout -out public.pem
ls
echo "Stacey's Mum" > my_file.txt
ls
openssl rsautl -encrypt -pubin -inkey public.pem -in my_file.txt -out encrypted.txt
more encrypted.txt
openssl rsautl -decrypt -inkey private.pem -in encrypted.txt -out plaintextoutput.txt
more plaintextoutput.txt
nano /var/www/html/tute4/encrypt.php
ls
curl icanhazip.com
mysql -u vm1 -h TODO http://lab-95a11ac6-8103-422e-af7e-4a8532f40144.australiaeast.cloudapp.azure.com --port 7065 -p
mysql -u vm1 -h lab-95a11ac6-8103-422e-af7e-4a8532f40144.australiaeast.cloudapp.azure.com --port 7065 -p
nano /var/www/html/tute4/DBConn.php
nano /var/www/remote_mysql_password.txt"
nano /var/www/remote_mysql_password.txt
chmod 777 /var/www/remote_mysql_password.txt
chmod -777 /var/www/remote_mysql_password.txt"
chmod -777 /var/www/remote_mysql_password.txt
chmod -777 /var/www/remote_mysql_password.txt
nano /var/www/html/tute4/DBConn.php
cd /var/www
ls
nano /var/www/remote_mysql_password.txt
sudo nano /var/www/remote_mysql_password.txt
cat /var/www/remote_mysql_password.txt
nano /var/www/html/tute4/DBConn.php
nano /var/www/html/tute4/output_xml.php
nano /var/www/html/tute4/parseXML.php
nano /var/www/html/tute4/output_json.php
ls
mkdir /var/www/html/tute5
cd /var/www/html/tute5
sudo apt install composer
composer require guzzlehttp/guzzle
nano /var/www/html/tute5/SayHello.php
nano /var/www/html/tute5/guzzle.php
ls
nano /var/www/html/tute5/guzzle.php
exit
ls
exit
cd /var/www/html/
git clone https://github.com/digininja/DVWA.git
ls
cd DVWA
mv config/config.inc.php.dist config/config.inc.php
mysql -u root -p
ls
ls dvwa
ls
cd ../
rm -r DVWA
ls
sudo rm -r DVWA
ls
git clone https://github.com/digininja/DVWA.git
ls
cd DVWA/
mv config/config.inc.php.dist config/config.inc.php
GRANT ALL PRIVILEGES ON dvwa.* TO dvwa@'localhost';
mysql -u root -p
ls
cd config/
ls
nano config.inc.php 
mysql -u dvwa -p -h 127.0.0.1
ls
nano config.inc.php 
cd ../
ls
nano login.php 
mysql -u root -p
ls
cd /config
cd ~
ld
ls
cd ~
ls
cd /var/www/html/
ls
sudo nano /var/www/html/.htaccess
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo nano /var/www/html/tute7/.htaccess
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /var/www/html/tute7/.htaccess
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo tail -f /var/log/apache2/error.log
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
ls -l /var/www/html/tute7/SayHello.php
sudo nano /etc/apache2/sites-available/000-default.conf
sudo nano /var/www/html/tute7/.htaccess
sudo nano /var/www/html/.htaccess
sudo systemctl restart apache2
sudo a2enmod rewrite
sudo nano /var/www/html/tute7/.htaccess
sudo systemctl restart apache2
sudo chmod 644 /var/www/html/tute7/.htaccess
sudo chown www-data:www-data /var/www/html/tute7/.htaccess
sudo systemctl restart apache2
LogLevel alert rewrite:trace3
sudo nano /var/www/html/tute7/.htaccess
sudo nano /etc/apache2/sites-available/000-default.conf
sudo apachectl configtest
sudo nano /etc/apache2/sites-available/000-default.conf
sudo apachectl configtest
sudo systemctl restart apache2
ls
sudo nano /etc/apache2/sites-available/000-default.conf
sudo apachectl configtest
sudo nano /var/www/html/tute7/.htaccess
sudo nano /var/www/html/.htaccess
sudo a2enmod rewrite
sudo systemctl restart apache2
cd /var/www/html/
ls
cd tute7
ls
sudo chmod 777 .htaccess 
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
cd /etc/apache2
ls
sudo nano /var/www/html/tute7/.htaccess
sudo nano /var/www/html/.htaccess
sudo nano /var/www/html/tute7/.htaccess
sudo nano /etc/apache2/sites-available/000-default.conf
sudo nano /etc/apache2/apache2.conf
sudo systemctl restart apache2
sudo tail -f /var/log/apache2/error.log
sudo nano /etc/apache2/sites-available/000-default.conf
sudo nano /var/www/html/tute7/.htaccess
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo apachectl configtest
sudo nano /var/www/html/.htaccess
sudo systemctl restart apache2
ls -l /var/www/html
ls -l /var/www/html/tute7
apache2ctl -M | grep rewrite
tail -n 50 /var/log/apache2/error.log
apache2ctl -S
sudo nano /etc/apache2/sites-available/000-default.conf
cd /etc/apache2/
ls
nano apache2.conf 
sudo nano apache2.conf 
sudo nano /var/www/html/.htaccess
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo nano /var/www/html/tute7/.htaccess
sudo systemctl restart apache2
cd /var/www/html/tute7
ls
ls -l .htaccess
sudo nano /etc/apache2/sites-available/000-default.conf
ls -l .htaccess
ls -l .htaccess 
sudo chmod 777 .htaccess 
ls -l .htaccess 
sudo systemctl restart apache2
cd /var/www/html/
ls
nano .htaccess 
cd tute7
ls
nano SayHellp
ls
nano SayHello.php 
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
cd ../
ls
nano .htaccess 
sudo a2enmod rewrite
ls
ls -la /var/www/html
sudo chmod 777 .htaccess 
ls -la /var/www/html
sudo a2enmod rewrite
sudo systemctl restart apache2
ls -la /var/www/html
sudo nano /etc/apache2/sites-available/000-default.conf
sudo nano /etc/apache2/mods-enabled/rewrite.load
sudo service apache2 restart
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
nano .htaccess 
cd tute7
ls
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
cd ../
ls
nano .htaccess 
cd tute7
nano .htaccess 
sudo nano /etc/apache2/mods-enabled/rewrite.load
sudo nano /etc/apache2/sites-available/000-default.conf
nano .htaccess 
sudo systemctl restart apache2cd
sudo systemctl restart apache2
cd ../
ls
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
cd tute
cd tute7
nano .htaccess 
sudo systemctl restart apache2
nano .htaccess 
sudo systemctl restart apache2
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo tail -n 50 /var/log/apache2/error.log
sudo nano /etc/apache2/sites-available/000-default.conf
sudo systemctl restart apache2
sudo tail -n 50 /var/log/apache2/error.log
sudo apache2ctl configtest
sudo chown www-data:www-data /var/www/html/tute7/.htaccess
sudo chmod 644 /var/www/html/tute7/.htaccess
sudo chown www-data:www-data /var/www/html/tute7/.htaccess
sudo chmod 644 /var/www/html/tute7/.htaccess
sudo systemctl restart apache2
sudo tail -n 50 /var/log/apache2/error.log
sudo apache2ctl -M | grep rewrite
cat /var/www/html/tute7/.htaccess
sudo nano /etc/apache2/apache2.conf
sudo systemctl restart apache2
sudo tail -n 100 /var/log/apache2/error.log
nano .htaccess 
sudo nano .htaccess 
sudo systemctl restart apache2
sudo apache2ctl -S
sudo nano /etc/apache2/sites-enabled/default-ssl.conf
sudo systemctl restart apache2
sudo a2enmod ssl
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo apache2ctl -S
sudo systemctl restart apache2
ls
exit
ls
sudo systemctl stop apache2
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
ls
source ~/.nvm/nvm.sh
nvm install 20
node -v
npm -v 
node index.js
npm init
npm install express
node index.js
npm install ejs
node index.js
sudo systemctl start apache2
ls
cd /var/www/html/
git clone https://github.com/lfwells/kit214-tutorial9-php.git
ls
sudo nano .htaccess 
cd kit214-tutorial9-php/
ls
sudo cat .htaccess 
sudo nano .htaccess 
sudo nano /etc/apache2/sites-enabled/default-ssl.conf
sudo a2enmod rewrite
sudo a2enmod headers
sudo systemctrl restart apache2
systemctl restart apache2
sudo systemctl restart apache2
sudo a2enmod headers
sudo systemctl stop apache2
npm -v
node -v
cd ~
ls
mkdir tute9
ls
cd tute9
ls
npm init
npm install express
ls
sudo nano package.json 
npm install mysql
node index.js
ls
cd php_web_scraper/
ls
php guzzle_requests.php 
ls
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 start
sudo service apache2 stop
node index.js
npm install axios
node index.js
sudo service apache2 start
sudo service apache2 stop
node index.js
sudo service apache2 start
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 start
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
[A
node index.js
git init
git add .
git rm --cached -r .nvm
git sdd .
git add .
git init
git add php_web_scraper
git add php_web_scraper2
git status
git commit -m "timing api"
git remote add origin https://github.com/KMtouzhele/timing_api.git
git push origin main
git push -u origin main
git branch
git push -u origin maater
git push -u origin master
git add .
git status
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
sudo service apache2 stop
node index.js
