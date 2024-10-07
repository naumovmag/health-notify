<?php

declare(strict_types=1);

namespace HealthNotify\Services;

use HealthNotify\DTO\HealthNotifyDTO;

/**
 * Class EmailNotifier
 */
class EmailNotifier extends Notifier
{
    /**
     * Send a notification message.
     *
     * @param HealthNotifyDTO $dto
     * @param array           $config Additional options for sending the notification.
     *
     * @return bool
     */
    public function send(HealthNotifyDTO $dto, array $config = []): bool
    {
        return parent::send($dto, $config);
    }
}
