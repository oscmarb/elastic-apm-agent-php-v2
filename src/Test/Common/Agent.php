<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Agent implements \JsonSerializable
{
    public function __construct(
        private ?string $ephemeralId,
        private ?string $name,
        private ?string $version,
    ) {
    }

    public function ephemeralId(): ?string
    {
        return $this->ephemeralId;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function version(): ?string
    {
        return $this->version;
    }

    public function jsonSerialize(): array
    {
        return [
            'ephemeral_id' => $this->ephemeralId,
            'name' => $this->name,
            'version' => $this->version,
        ];
    }
}