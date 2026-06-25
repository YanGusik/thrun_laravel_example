<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Messages\CpuIntensiveMessage;
use App\Messages\IoWaitMessage;
use App\Messages\NoopMessage;
use App\Messages\SendEmailMessage;
use Faker\Factory;
use Illuminate\Console\Command;
use Thrun\Laravel\Bus\ThrunMessageBus;

final class ThrunSendEmailDispatch extends Command
{
    protected $signature = 'thrun:email:dispatch {count=1 : Number of messages to dispatch}';

    protected $description = 'Dispatch benchmark messages to Thrun queue';

    public function handle(ThrunMessageBus $bus): int
    {
        $count = (int) $this->argument('count');

        $start = hrtime(true);

        for ($i = 1; $i <= $count; $i++) {
            $message = new SendEmailMessage(Factory::create()->email, Factory::create()->email);
            $bus->dispatch($message, 'emails');
        }

        $elapsedMs = (hrtime(true) - $start) / 1e6;

        $this->info("Dispatched {$count} messages in {$elapsedMs}ms");

        return self::SUCCESS;
    }
}
