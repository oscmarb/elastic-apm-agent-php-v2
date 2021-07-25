<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class MessageQueue implements \JsonSerializable
{
    public function __construct(private ?string $description)
    {
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function jsonSerialize(): array
    {
        return ['description' => $this->description];
    }
}