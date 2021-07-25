<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class Container implements \JsonSerializable
{
    public function __construct(private ?string $id)
    {
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}