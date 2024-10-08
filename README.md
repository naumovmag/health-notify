# Healthcheck Notify

HealthNotifier is a library for performing system health checks and sending notifications upon issue detection. Easily configurable to fit your project's needs, it ensures continuous monitoring of your applications and prompts quick responses to failures, enhancing the reliability and stability of your infrastructure.

## Installation

To install the library, run the following command:

```bash
composer require naumov-adata/health-notify
```

To register the provider, add the following in the `providers` section of the `config/app.php` file:

```php
\HealthNotify\Providers\HealthNotifyServiceProvider::class
```

## Dependencies

The library requires the following dependencies:

- PHP version `^8.1`
- illuminate/console version `^9.0|^10.0`
- adata-team/healthchecker version `^2.0`
- illuminate/container version `^9.0|^10.0`
- illuminate/support version `^9.0|^10.0`

This library is designed for Laravel 10+ and requires the `adata-team/healthchecker` library to function.

## Telegram Notification Setup

1. In Telegram, find the BotFather bot and create a new bot, save the token as it will be needed below.
2. Create a channel, make the bot an administrator of the channel, and get the channel ID.
3. Add the following parameters to the `.env` file:

```
TELEGRAM_BOT_TOKEN=
TELEGRAM_CHAT_ID=
```

Set the obtained values accordingly.

## Verifying Functionality

Ensure that the `adata-team/healthchecker` library is working and checks the necessary services.

## Cron Setup

Add the following command to cron with the desired frequency:

```bash
php artisan health:notify
```

## License

Proprietary. This library has a proprietary license.

## Authors

- naumov ([naumov_@mail.ru](mailto:naumov_@mail.ru))