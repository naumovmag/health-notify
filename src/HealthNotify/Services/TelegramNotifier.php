<?php

declare(strict_types=1);

namespace HealthNotify\Services;

use Exception;
use HealthNotify\DTO\HealthNotifyDTO;
use Illuminate\Support\Facades\Http;

/**
 * Class TelegramNotifier
 */
final class TelegramNotifier extends Notifier
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
        $botToken = data_get($config, 'bot_token');
        $chatId   = data_get($config, 'chat_id');
        $endpoint = sprintf('https://api.telegram.org/bot%s/sendMessage', $botToken);
        $message  = $dto->toMarkdownMessage();

        $params = [
            'chat_id'    => $chatId,
            'text'       => $message,
        ];

        try {
            $response = Http::retry(3)
                            ->post($endpoint, $params);
            $status   = $response->successful();
            $this->logNotification($message, $status);

            return $status;
        } catch (Exception $e) {
            $this->logNotification($message, false, $e);

            return false;
        }
    }
}
