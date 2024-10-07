<?php

namespace HealthNotify\Handlers;

use Adata\HealthChecker\Http\Controllers\HealthController;
use HealthNotify\DTO\HealthNotifyDTO;
use HealthNotify\Services\Notifier;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Class HealthNotifyHandler
 */
class HealthNotifyHandler
{
    /**
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(): void
    {
        $notificationChannels = Config::get('healthnotify.notifications.channels', []);

        /** @var HealthController $healthController */
        $healthController = App::make(HealthController::class);
        $response         = $healthController->index();
        $healthData       = $response->getData(true);

        if (data_get($healthData, 'health') !== 'green') {
            $this->notifyChannels(HealthNotifyDTO::fromHealthCheck($healthData), $notificationChannels);
        }
    }

    /**
     * Notify all enabled channels about the health check failure.
     *
     * @param \HealthNotify\DTO\HealthNotifyDTO $dto
     * @param array                             $channels
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function notifyChannels(HealthNotifyDTO $dto, array $channels): void
    {
        foreach ($channels as $channelConfig) {
            if (data_get($channelConfig, 'enabled', false)) {
                /** @var Notifier $notifier */
                $notifier = Container::getInstance()
                                     ->make(data_get($channelConfig, 'class'));
                $notifier->send($dto, $channelConfig);
            }
        }
    }
}
