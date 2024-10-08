<?php

declare(strict_types=1);

namespace HealthNotify\Console;

use HealthNotify\Handlers\HealthNotifyHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Command\Command as CommandAlias;

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
     * @return int
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(): int
    {
        if (App::environment() !== 'production') {
            $this->warn('The command is intended only for working in a productive environment.');

            return CommandAlias::SUCCESS;
        }

        $this->handler->handle();

        $this->info('The health check has been done successfully.');

        return CommandAlias::SUCCESS;
    }
}
