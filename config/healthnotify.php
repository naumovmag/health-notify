<?php

return [
    'notifications' => [
        'channels' => [
            'telegram' => [
                'enabled'   => true,
                'bot_token' => env('TELEGRAM_BOT_TOKEN', '7641199608:AAEw_4VUJ0qNngIfu64qPCwUfHMC-9t93a4'),
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
