<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Messages\NoopMessage;
use Thrun\Laravel\Handler\AsThrunHandler;
use Thrun\Worker\Acknowledger;

#[AsThrunHandler]
final class NoopHandler
{
    public function __invoke(NoopMessage $message, ?Acknowledger $ack = null): void
    {
        $ack?->ack();
    }
}
