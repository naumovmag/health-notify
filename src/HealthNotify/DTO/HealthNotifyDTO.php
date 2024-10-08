<?php

declare(strict_types=1);

namespace HealthNotify\DTO;

use Illuminate\Support\Facades\App;

/**
 * Class HealthNotifyDTO
 */
class HealthNotifyDTO
{
    /**
     * @param string $name
     * @param array  $services
     */
    public function __construct(
        private readonly string $name,
        private readonly array  $services,
    ) {
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the services.
     *
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * Create an instance from health check data.
     *
     * @param array $healthCheckData
     *
     * @return self
     */
    public static function fromHealthCheck(array $healthCheckData): self
    {
        $name           = data_get($healthCheckData, 'app');
        $failedServices = array_filter($healthCheckData['services'], function ($service) {
            return $service['result'] === 'fail';
        });
        $services       = array_keys($failedServices);

        return new self($name, $services);
    }

    /**
     * Generate a markdown message for Telegram.
     *
     * @return string
     */
    public function toMarkdownMessage(): string
    {
        $environment = App::environment();
        $serviceList = implode(
            "\n",
            array_map(fn($service) => "❗️ {$service} - is down or has a connection issue.", $this->services)
        );

        return sprintf(
            "Environment: \"%s\".\n Service: \"%s\"\n HealthChecker has detected issues:\n%s",
            $environment,
            $this->name,
            $serviceList
        );
    }
}
