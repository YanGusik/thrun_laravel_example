<?php

declare(strict_types=1);

namespace App\Messages;

final readonly class IoWaitMessage
{
    public function __construct(
        public int $id,
        public int $delayMs = 50,
    ) {
    }
}
