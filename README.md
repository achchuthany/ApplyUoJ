Prerequiste
Install Composer
Install nodejs and npm
sudo apt install -y php7.4 php7.4-gd php7.4-mbstring php7.4-xml php-zip 

### Install Composer Dependencies
`composer install`

### Install NPM Dependencies
`npm install`

### Generate Assets
`npm run prod`

### Create a copy of your .env file
`cp .env.example .env`

### Generate an app encryption key
`php artisan key:generate`

### Migrate the database
`php artisan migrate`

### Seed the database
`php artisan db:seed`

### Generate any events
`php artisan event:generate`

### Starting The Scheduler
`* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

### The Public Disk
`php artisan storage:link`


### Optimization
`composer install --optimize-autoloader --no-dev`

`php artisan config:cache`

`php artisan route:cache`

`php artisan view:cache`
