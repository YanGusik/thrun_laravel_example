<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Messages\IoWaitMessage;
use Thrun\Laravel\Handler\AsThrunHandler;
use Thrun\Worker\Acknowledger;

#[AsThrunHandler]
final class IoWaitHandler
{
    public function __invoke(IoWaitMessage $message, ?Acknowledger $ack = null): void
    {
        usleep($message->delayMs * 1000);

        echo "[THRUN IO] Done: id={$message->id}\n";
        $ack?->ack();
    }
}
