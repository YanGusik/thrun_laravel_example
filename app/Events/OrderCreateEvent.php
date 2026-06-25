<?php

namespace App\Events;

use Thrun\Laravel\Event\Attribute\ThrunEventListener;

#[ThrunEventListener('order.create')]
class OrderCreateEvent
{
    public function __invoke(mixed $payload)
    {
        echo "[OrderCreateEvent] receive event {$payload['id']}\n";
    }
}
