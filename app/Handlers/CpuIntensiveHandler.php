<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Messages\CpuIntensiveMessage;
use Thrun\Laravel\Handler\AsThrunHandler;
use Thrun\Worker\Acknowledger;

//#[AsThrunHandler(CpuIntensiveMessage::class)]
final class CpuIntensiveHandler
{
    public function __invoke(CpuIntensiveMessage $message, ?Acknowledger $ack = null): void
    {
        $x = 0.0;
        for ($i = 0; $i < $message->iterations; $i++) {
            $x += sin($i) * cos($i);
        }

//        echo "[THRUN CPU] Done: id={$message->id}\n";
        $ack?->ack();
    }
}
