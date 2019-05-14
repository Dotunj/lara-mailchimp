<?php

namespace Dotunj\LaraMailChimp;

use DrewM\MailChimp\MailChimp;

class LaraMailChimp
{
    protected $mailchimp;

    protected $listId;

    public function __construct(MailChimp $mailChimp, string $listId)
    {
        $this->mailchimp = $mailChimp;

        $this->listId = $listId;

    }

    public function subscribe($email)
    {

        $result = $this->mailchimp->post("lists/$this->listId/members", [
              'email_address' => $email,
              'status' => 'subscribed'
        ]);

        return $result;
    }
}
