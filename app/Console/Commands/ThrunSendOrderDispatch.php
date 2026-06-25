<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Messages\OrderCreateMessage;
use App\Messages\SendEmailMessage;
use Faker\Factory;
use Illuminate\Console\Command;
use Thrun\Laravel\Bus\ThrunMessageBus;

final class ThrunSendOrderDispatch extends Command
{
    protected $signature = 'thrun:order:dispatch {count=1 : Number of messages to dispatch}';

    protected $description = 'Dispatch benchmark messages to Thrun queue';

    public function handle(ThrunMessageBus $bus): int
    {
        $count = (int) $this->argument('count');

        $start = hrtime(true);

        for ($i = 1; $i <= $count; $i++) {
            $message = new OrderCreateMessage($i);
            $bus->dispatch($message);
        }

        $elapsedMs = (hrtime(true) - $start) / 1e6;

        $this->info("Dispatched {$count} messages in {$elapsedMs}ms");

        return self::SUCCESS;
    }
}
