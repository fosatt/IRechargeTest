# How to set this project on your local machine
- To set up this project on your local machine, follow the guide below

## Requirements
- "php": "^7.4"
- "laravel/framework": "^8.75"
- MySql
- composer

## Steps to Setup
- Install all dependencies with  composer install 
- Create a new database (eg: test_db) on MySQL (phpMyAdmin)
- Copy & rename the file .env.example to .env at the root directory
- update the .env file, setup your db connection and include your FLUTTERWAVE_ENCRYPTION_KEY and FLUTTERWAVE_SECRET_KEY
- php artisan key:generate to generate the default application key
- php artisan migrate --seed to load the database with the basic information
- serve application with php artisan serve or on homestead

## API collections and documentation 
https://documenter.getpostman.com/view/21200002/2s93JnUmbe#   I R e c h a r g e T e s t  
 