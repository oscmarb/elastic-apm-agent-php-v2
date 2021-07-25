<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Configuration;

class Configuration
{
    public function __construct(
        private string $appName,
        private string $environment = 'dev',
        private bool $active = true,
        private string $appVersion = '',
        private ?string $frameworkName = null,
        private ?string $frameworkVersion = null,
        private int $stacktraceLimit = 0,
        private bool $metricSet = true
    ) {
    }

    public function appName(): string
    {
        return $this->appName;
    }

    public function environment(): string
    {
        return $this->environment;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function appVersion(): string
    {
        return $this->appVersion;
    }

    public function frameworkName(): ?string
    {
        return $this->frameworkName;
    }

    public function frameworkVersion(): ?string
    {
        return $this->frameworkVersion;
    }

    public function stacktraceLimit(): int
    {
        return $this->stacktraceLimit;
    }

    public function metricSet(): bool
    {
        return $this->metricSet;
    }
}