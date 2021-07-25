<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Framework implements \JsonSerializable
{
    public function __construct(private ?string $name, private ?string $version)
    {
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
            'name' => $this->name,
            'version' => $this->version,
        ];
    }
}