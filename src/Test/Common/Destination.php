<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Destination implements \JsonSerializable
{
    public function __construct(private ?string $address, private ?int $port, private ?Service $service)
    {
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function port(): ?int
    {
        return $this->port;
    }

    public function service(): ?Service
    {
        return $this->service;
    }

    public function jsonSerialize(): array
    {
        return [
            'address' => $this->address,
            'port' => $this->port,
            'service' => $this->service,
        ];
    }
}