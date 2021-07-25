<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Runtime implements \JsonSerializable
{
    public function __construct(private ?string $description, private ?string $version)
    {
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function version(): ?string
    {
        return $this->version;
    }

    public function jsonSerialize(): array
    {
        return [
            'description' => $this->description,
            'version' => $this->version,
        ];
    }
}