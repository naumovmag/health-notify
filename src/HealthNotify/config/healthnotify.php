<?php

return [
    'notifications' => [
        'channels' => [
            'telegram' => [
                'enabled'   => true,
                'bot_token' => env('TELEGRAM_BOT_TOKEN', '7641199608:AAFMGHQE_gP0De-xu8HaOnob411Bsui-96o'),
                'chat_id'   => env('TELEGRAM_CHAT_ID', '@adata_health'),
                'class'     => \HealthNotify\Services\TelegramNotifier::class,
            ],
            'email'    => [
                'enabled' => false,
                'class'   => \HealthNotify\Services\EmailNotifier::class,
            ],
        ],
    ],
];
