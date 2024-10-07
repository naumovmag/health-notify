<?php

declare(strict_types=1);

namespace HealthNotify\Services;

use Exception;
use HealthNotify\DTO\HealthNotifyDTO;
use Illuminate\Support\Facades\Log;

/**
 * CLass Notifier
 */
abstract class Notifier implements NotificationInterface
{
    /**
     * Send a notification message.
     *
     * @param HealthNotifyDTO $dto
     * @param array           $config
     *
     * @return bool
     */
    public function send(HealthNotifyDTO $dto, array $config = []): bool
    {
        return false;
    }

    /**
     * Log the notification attempt.
     *
     * @param string         $message
     * @param bool           $status
     * @param Exception|null $e
     *
     * @return void
     */
    protected function logNotification(string $message, bool $status, ?Exception $e = null): void
    {
        Log::warning(
            sprintf("Healthcheck notification: '%s' | Status: %s\n", $message, $status ? 'Success' : 'Failure'),
            ['error' => $e?->getTraceAsString()]
        );
    }
}
