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

Set the permissions:
    sudo chown -R www-data:www-data /path/to/your/laravel/root/directory
    sudo find /path/to/your/laravel/root/directory -type f -exec chmod 644 {} \;    
    sudo find /path/to/your/laravel/root/directory -type d -exec chmod 755 {} \;
    sudo chgrp -R www-data storage bootstrap/cache
    sudo chmod -R ug+rwx storage bootstrap/cache

Run `composer install`.

You should now have a file called `.env` in the root directory. If you don't, copy or rename the file `.env.example`.  
Edit it to include you DB connection.

Run the php artisan command `php artisan key:generate` to create an application key. Without it the app won't work.

Now run `php artisan migrate:refresh --seed` to create all tables for this application, and add some example data to the application.  
This will also add an example "admin" user with email "admin@test.com" and a random password. The password is printed on the command line.

And that's it, you are now ready to use the application!

For testing please add
    "test" : [
            "vendor/bin/phpunit"
        ]

to your `composer.json`, and `<env name="DB_CONNECTION" value="mysql"/>` to `your phpunit.xml`. Then run `composer test` to run all tests. 
