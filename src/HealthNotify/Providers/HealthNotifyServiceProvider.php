<?php

namespace HealthNotify\Providers;

use HealthNotify\Console\HealthNotifyCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class HealthNotifyServiceProvider
 */
class HealthNotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/healthnotify.php',
            'healthnotify'
        );

        $this->commands([
                            HealthNotifyCommand::class,
                        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Опционально: публикация конфигурационного файла
        if ($this->app->runningInConsole()) {
            $this->publishes([
                                 __DIR__ . '/../config/healthnotify.php' => config_path('healthnotify.php'),
                             ], 'config');
        }
    }
}
