<?php

declare(strict_types=1);

namespace HealthNotify\Console;

use HealthNotify\Handlers\HealthNotifyHandler;
use Illuminate\Console\Command;

/**
 * Class HealthNotifyCommand
 */
class HealthNotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check health status of services and notify if there are issues.';

    /**
     * HealthNotifyCommand constructor.
     *
     * @param HealthNotifyHandler $handler
     */
    public function __construct(
        private readonly HealthNotifyHandler $handler
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(): void
    {
        $this->handler->handle();

        $this->info('The health check has been done successfully.');
    }
}
