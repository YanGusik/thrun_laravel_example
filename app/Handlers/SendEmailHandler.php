<?php

namespace App\Handlers;

use App\Messages\SendEmailMessage;
use Thrun\Worker\Acknowledger;

class SendEmailHandler
{
    public function __invoke(SendEmailMessage $message, Acknowledger $acknowledger)
    {
        $acknowledger->ack();
    }
}
