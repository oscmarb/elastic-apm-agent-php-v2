<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class Machine implements \JsonSerializable
{
    public function __construct(private ?string $type)
    {
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}