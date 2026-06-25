<?php

declare(strict_types=1);

namespace App\Messages;

final readonly class NoopMessage
{
    public function __construct(public int $id)
    {
    }
}
