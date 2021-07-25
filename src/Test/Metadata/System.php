<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class System implements \JsonSerializable
{
    public function __construct(
        private ?string $architecture,
        private ?string $configuredHostname,
        private ?Container $container,
        private ?string $detectedHostname,
        private ?string $hostname,
        private ?Kubernetes $kubernetes,
        private ?string $platform
    ) {
    }

    public function architecture(): ?string
    {
        return $this->architecture;
    }

    public function configuredHostname(): ?string
    {
        return $this->configuredHostname;
    }

    public function container(): ?Container
    {
        return $this->container;
    }

    public function detectedHostname(): ?string
    {
        return $this->detectedHostname;
    }

    public function hostname(): ?string
    {
        return $this->hostname;
    }

    public function kubernetes(): ?Kubernetes
    {
        return $this->kubernetes;
    }

    public function platform(): ?string
    {
        return $this->platform;
    }

    public function jsonSerialize(): array
    {
        return [
            'architecture' => $this->architecture,
            'configuredHostname' => $this->configuredHostname,
            'container' => $this->container,
            'detectedHostname' => $this->detectedHostname,
            'hostname' => $this->hostname,
            'kubernetes' => $this->kubernetes,
            'platform' => $this->platform,
        ];
    }
}