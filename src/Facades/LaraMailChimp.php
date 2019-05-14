<?php

namespace Dotunj\LaraMailChimp\Facades;

use Illuminate\Support\Facades\Facade;

class LaraMailChimp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'lara-mailchimp';
    }
}
