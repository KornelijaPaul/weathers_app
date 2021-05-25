# weathers_app

Well hi there! This repository holds the code and script
for the simple weather search page.

## Setup

If you've just downloaded the code, congratulations!!

To get it working, follow these steps:

Copy .env_dev file update DATABASE_URL and save as .env in the root of project.

**Download Composer dependencies**

Make sure you have [Composer installed](https://getcomposer.org/download/)
and then run:

```
composer install
```

You may alternatively need to run `php composer.phar install`, depending
on how you installed Composer.

**Start the built-in web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To start the web server, open a terminal, move into the
project, and run:

```
symfony serve
```

(If this is your first time using this command, you may see an
error that you need to run `symfony server:ca:install` first).

Database is not used yet in this app, but for convenience run the command below so we have this in hand if needed in the near future 
```
 php bin/console doctrine:database:create
 ```

Now check out the site at `https://localhost:8000`

Have fun!

## Thanks!
