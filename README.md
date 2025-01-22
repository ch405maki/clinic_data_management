# make sure you allready setup (xampp, composer, node.js)

# on terminal make a copy of .env file by putting this command

cp .env.example .env

# then in terminal run this to install composer

composer install
composer update

# then generate a key 

php artisan key:generate

# now you can setup your connection with database
# on .env file  look for

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=databaseName <- ((Change this to your Database Name))
DB_USERNAME=root
DB_PASSWORD=

# you can now run migration by running the command

php artisan migrate
php artisan migrate --seed

# now install NPM

npm install

# you can now run your web app

npm run dev

# + new terminal for

php artisan serve