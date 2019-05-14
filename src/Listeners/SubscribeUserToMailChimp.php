<?php

namespace Dotunj\LaraMailChimp\Listeners;

use Dotunj\LaraMailChimp\LaraMailChimp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Dotunj\LaraMailChimp\Events\UserRegistered;

class SubscribeUserToMailChimp implements ShouldQueue
{
    public $laraMailChimp;

    public function __construct(LaraMailChimp $laraMailChimp)
    {
        $this->laraMailChimp = $laraMailChimp;
    }

    public function handle(UserRegistered $event)
    {
        $this->laraMailChimp->subscribe($event->user->email);
    }
}
