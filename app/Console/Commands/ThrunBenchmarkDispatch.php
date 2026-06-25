<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Messages\CpuIntensiveMessage;
use App\Messages\IoWaitMessage;
use App\Messages\NoopMessage;
use Illuminate\Console\Command;
use Thrun\Laravel\Bus\ThrunMessageBus;

final class ThrunBenchmarkDispatch extends Command
{
    protected $signature = 'thrun:benchmark:dispatch
                            {type : Type of benchmark (cpu|io|noop)}
                            {count=100 : Number of messages to dispatch}';

    protected $description = 'Dispatch benchmark messages to Thrun queue';

    public function handle(ThrunMessageBus $bus): int
    {
        $type  = $this->argument('type');
        $count = (int) $this->argument('count');

        if (!in_array($type, ['cpu', 'io', 'noop'], true)) {
            $this->error('Invalid type. Allowed: cpu, io, noop');

            return self::FAILURE;
        }

        $start = hrtime(true);

        for ($i = 1; $i <= $count; $i++) {
            $message = match ($type) {
                'cpu' => new CpuIntensiveMessage($i),
                'io' => new IoWaitMessage($i),
                'noop' => new NoopMessage($i),
            };

            if ($type == 'cpu') {
                $bus->dispatch($message, 'heavy_cpu');
            } else {
                $bus->dispatch($message, 'emails');
            }
        }

        $elapsedMs = (hrtime(true) - $start) / 1e6;

        $this->info("Dispatched {$count} {$type} messages in {$elapsedMs}ms");

        return self::SUCCESS;
    }
}
