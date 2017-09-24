# Highscores


This is a basic app created with [Laravel 5.5](https://github.com/laravel).


## Prerequisites


Make sure you have [composer](https://getcomposer.org/) installed.

You will need PHP 7.0.0 or higher with the OpenSSL, PDO, Mbstring, Tokinzer and XML PHP Extensions.

Alternatively, you can use Homestead, a [Laravel Virtual Machine](https://laravel.com/docs/5.5/homestead).
For a comprehensive installation guide for Laravel have a look at the [documentation](https://laravel.com/docs/5.5/installation).


## Installing


Create a database and a database user for this app.

Clone the repo
    git clone https://github.com/miaulalala/highscores.git
    
Set the directory owner to `www-data:www-data`.

Set the directory permissions to `777` (this will be changed later).

Run `composer install`.

Change permissions to `775`.

You should now have a file called `.env` in the root directory. Edit it to include you DB connection.

Run the php artisan command `php artisan key:generate` to create an application key. Without it the app won't work.

Now run `php artisan migrate:refresh --seed` to create all tables for this application, and add some example data to the application.  
This will also add an example "admin" user with email "admin@test.com", a random password, and a random API token.
