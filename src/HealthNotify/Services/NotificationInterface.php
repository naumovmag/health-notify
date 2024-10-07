<?php

declare(strict_types=1);

namespace HealthNotify\Services;

use HealthNotify\DTO\HealthNotifyDTO;

/**
 * NotificationInterface
 */
interface NotificationInterface
{
    /**
     * Send a notification message.
     *
     * @param HealthNotifyDTO $dto
     * @param array           $config
     *
     * @return bool
     */
    public function send(HealthNotifyDTO $dto, array $config = []): bool;
}
