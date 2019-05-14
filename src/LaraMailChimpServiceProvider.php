<?php

namespace Dotunj\LaraMailChimp;

use Illuminate\Support\ServiceProvider;
use Dotunj\LaraMailChimp\LaraMailChimp;
use Dotunj\LaraMailChimp\Events\UserRegistered;
use Dotunj\LaraMailChimp\Listeners\SubscribeUserToMailChimp;
use DrewM\MailChimp\MailChimp;

class LaraMailChimpServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/lara-mailchimp.php', 'lara-mailchimp');

        $this->publishes([
            __DIR__.'/../config/lara-mailchimp.php' => config_path('lara-mailchimp.php')
        ], 'config');

        $this->app['events']->listen(UserRegistered::class, SubscribeUserToMailChimp::class);
    }

    public function register()
    {
       $this->app->singleton(LaraMailChimp::class, function() {
           $mailchimp = new MailChimp(config('lara-mailchimp.api_key'));

           $listId = config('lara-mailchimp.list_id');

           return new LaraMailChimp($mailchimp, $listId);
       });

    }
}