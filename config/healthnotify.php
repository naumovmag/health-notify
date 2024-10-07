<?php

return [
    'notifications' => [
        'channels' => [
            'telegram' => [
                'enabled'   => true,
                'bot_token' => env('TELEGRAM_BOT_TOKEN'),
                'chat_id'   => env('TELEGRAM_CHAT_ID',),
                'class'     => \HealthNotify\Services\TelegramNotifier::class,
            ],
            'email'    => [
                'enabled' => false,
                'class'   => \HealthNotify\Services\EmailNotifier::class,
            ],
        ],
    ],
];
