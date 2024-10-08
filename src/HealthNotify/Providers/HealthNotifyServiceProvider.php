<?php

namespace HealthNotify\Providers;

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
    }
}
