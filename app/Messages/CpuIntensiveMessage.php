<?php

declare(strict_types=1);

namespace App\Messages;

final readonly class CpuIntensiveMessage
{
    public function __construct(
        public int $id,
        public int $iterations = 20_000_000,
    ) {
    }
}
