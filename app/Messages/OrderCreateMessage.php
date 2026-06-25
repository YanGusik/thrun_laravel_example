<?php

namespace App\Messages;

use Thrun\Laravel\Handler\Attribute\Delay;
use Thrun\Laravel\Handler\Attribute\Queue;
use Thrun\Laravel\Handler\Attribute\Retry;

#[Queue('emails')]
#[Retry(backoff: [1000, 2000, 4000], maxAttempts: 3)]
final readonly class OrderCreateMessage
{
    public function __construct(public int $orderId) {}
}
