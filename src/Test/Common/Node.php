<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Node implements \JsonSerializable
{
    public function __construct(private ?string $configuredName)
    {
    }

    public function configuredName(): ?string
    {
        return $this->configuredName;
    }

    public function jsonSerialize(): array
    {
        return ['configured_name' => $this->configuredName];
    }
}