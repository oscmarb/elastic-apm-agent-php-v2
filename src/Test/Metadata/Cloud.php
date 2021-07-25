<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class Cloud implements \JsonSerializable
{
    public function __construct(
        private ?Account $account,
        private ?string $availabilityZone,
        private ?Instance $instance,
        private ?Machine $machine,
        private ?Project $project,
        private string $provider,
        private ?string $region,
        private ?CloudService $service,
    ) {
    }

    public function account(): ?Account
    {
        return $this->account;
    }

    public function availabilityZone(): ?string
    {
        return $this->availabilityZone;
    }

    public function instance(): ?Instance
    {
        return $this->instance;
    }

    public function machine(): ?Machine
    {
        return $this->machine;
    }

    public function project(): ?Project
    {
        return $this->project;
    }

    public function provider(): string
    {
        return $this->provider;
    }

    public function region(): ?string
    {
        return $this->region;
    }

    public function service(): ?CloudService
    {
        return $this->service;
    }

    public function jsonSerialize(): array
    {
        return [
            'account' => $this->account,
            'availabilityZone' => $this->availabilityZone,
            'instance' => $this->instance,
            'machine' => $this->machine,
            'project' => $this->project,
            'provider' => $this->provider,
            'region' => $this->region,
            'service' => $this->service,
        ];
    }
}