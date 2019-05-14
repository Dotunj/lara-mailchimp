<?php

namespace Dotunj\LaraMailChimp\Tests;

use Orchestra\Testbench\TestCase;
use Mockery;
use DrewM\MailChimp\MailChimp;
use Dotunj\LaraMailChimp\LaraMailChimp;

class LaraMailChimpTest extends TestCase
{
    protected $mailChimp;

    protected $listId;

    protected $laraMailChimp;

    public function setUp() : void
    {
        $this->mailChimp = Mockery::mock(MailChimp::class);

        $this->listId = '45673892';

        $this->laraMailChimp = new LaraMailChimp($this->mailChimp, $this->listId);
    }

    /** @test */
    public function it_can_subscribe_a_user()
    {
        $email = 'dotun@gmail.com';

        $url = 'lists/' .$this->listId. '/members';

        $this->mailChimp->shouldReceive('post')->withArgs([
            $url, [
                'email_address' => $email,
                'status' => 'subscribed'
            ],
        ]);

       $this->laraMailChimp->subscribe($email);

       $this->mailChimp->shouldReceive('success')->andReturn(true);
    }
}