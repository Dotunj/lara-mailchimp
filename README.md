# lara-mailchimp
This package automatically subscribes registered users in a Laravel application to a mailchimp list.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/Dotunj/lara-mailchimp.svg?branch=master)](https://travis-ci.org/Dotunj/lara-mailchimp) 
[![StyleCI](https://github.styleci.io/repos/186693310/shield?branch=master)](https://github.styleci.io/repos/186693310)

## Installation

To install via composer, run the following command:

```bash
composer require dotunj/lara-mailchimp
```

If you are on Laravel 5.4 or below, register the `Dotunj\LaraMailChimp\LaraMailChimpServiceProvider` service provider in the `config/app.php` file.

```php
<?php

return [

  'providers' => [
        
        /*
         * Package Service Providers...
         */
         Dotunj\LaraMailChimp\LaraMailChimpServiceProvider::class,
         
   ]
]
```
From Laravel 5.5 and above, the service provider will automatically be registered by Laravel


## Configuration
To publish the `config` file, run:
```bash
php artisan vendor:publish --provider="Dotunj\LaraMailChimp\LaraMailChimpServiceProvider"
```
This will publish a `lara-mailchimp.php` file to the config directory with the following content:

```php
<?php

return [
    'api_key' => env('MAILCHIMP_API_KEY'),
    'list_id' => env('MAILCHIMP_LIST_ID'),
];
```
Next, edit your `.env` file with your mailchimp details:
```bash
MAILCHIMP_API_KEY=xxxx
MAILCHIMP_LIST_ID=xxxx
```
## Usage
To subscribe a user's email on registration to your mailchimp list, import the `Dotunj\LaraMailChimp\Events\UserRegistered` event at the top of the `User` model. Next, define a `$dispatchesEvent`
property on the `User` model that maps the `created` lifecylce hook to the `UserRegistered` event.

```php
<?php

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Dotunj\LaraMailChimp\Events\UserRegistered;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $dispatchesEvents = [
        'created' => UserRegistered::class
    ];
 
}
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.



