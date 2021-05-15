## Server Requirement 
* OS: Ubuntu Server 20.04 LTS
* Laravel Version: 8.x
* PHP version: 7.4
* Nodejs Version: 14.17.0
* NPM Version : 7.9.0
* Composer Version: 2.0.11

## Installation

### Step 1 – Installing LAMP Stack
#### Install PHP
`sudo apt install zip unzip software-properties-common`

`sudo add-apt-repository ppa:ondrej/php`

`sudo apt install -y php7.4 php7.4-gd php7.4-mbstring php7.4-xml php-zip`

#### Apache2
`sudo apt install apache2 libapache2-mod-php7.4`

#### Install MySQL
`sudo apt install mysql-server php7.4-mysql`

`sudo mysql_secure_installation`

#### Create MySQL User and Database
`CREATE DATABASE applyuoj;`

`CREATE USER 'applyuojuser'@'localhost' IDENTIFIED BY 'secret';`

`GRANT ALL ON applyuoj.* to 'applyuojuser'@'localhost';`

`FLUSH PRIVILEGES;`


### Step 2 – Installing Composer
`curl -sS https://getcomposer.org/installer | php`

`sudo mv composer.phar /usr/local/bin/composer`

`sudo chmod +x /usr/local/bin/composer`

### Step 3 - Installing Nodejs
Node Version Manager: https://github.com/nvm-sh/nvm

`curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.38.0/install.sh | bash`

`source ~/.bashrc`

`nvm list-remote`

`nvm install v14.17.0`

`nvm use v14.17.0`

### Step 4 – Download and Install ApplyUoJ
#### Download from Git
`cd /var/www`

`git clone https://github.com/achchuthany/ApplyUoJ.git`

`cd /var/www/ApplyUoJ`

#### Install Composer Dependencies
`composer install`

#### Install NPM Dependencies
`npm install`

#### Generate Assets
`npm run prod`

#### Create a copy of your .env file
`cp .env.example .env`
Now edit the .env file and update database and email settings.

#### Generate an app encryption key
`php artisan key:generate`

#### Migrate the database
`php artisan migrate`

#### Seed the database
`php artisan db:seed`

#### Generate any events
`php artisan event:generate`

#### The Public Disk
`php artisan storage:link`

#### Files permissions 
```
chown -R www-data.www-data /var/www/ApplyUoJ
chmod -R 755 /var/www/ApplyUoJ
chmod -R 777 /var/www/ApplyUoJ/storage
```
### Step 5 - Apache Configuration

`sudo vim /etc/apache2/sites-enabled/000-default.conf`

Update the configuration like below:

``` 
<VirtualHost *:80>
        ServerAdmin webmaster@localhost
        DocumentRoot /var/www/ApplyUoJ/public

        <Directory />
                Options FollowSymLinks
                AllowOverride None
        </Directory>
        <Directory /var/www/ApplyUoJ>
                AllowOverride All
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```

Reload Apache configuration

`sudo systemctl restart apache2 `

### Step 6 - Cron configuration
To set up cron jobs, enter:

`crontab -e`

Update the configuration like below:

`* * * * * cd /var/www/ApplyUoJ && php artisan schedule:run >> /dev/null 2>&1`


###Step 7 -  Optimization
`composer install --optimize-autoloader --no-dev`

`php artisan config:cache`

`php artisan route:cache`

`php artisan view:cache`
