# CF Sample App PHP

A sample [Lumen](https://lumen.laravel.com/) application to deploy to Cloud Foundry which works out of the box.

## Run locally

1. Install [PHP](https://secure.php.net/manual/en/install.php)
1. Install [Composer](https://getcomposer.org/download/) globally on your machine
1. Run `composer install`
1. Run `php -S localhost:3000 -t public`
1. Visit [http://localhost:3000](http://localhost:3000)

## Run in the cloud

1. Install the [cf CLI](https://github.com/cloudfoundry/cli#downloads)
1. Run `cf push my-php-app -m 128M --random-route`
1. Visit the given URL
