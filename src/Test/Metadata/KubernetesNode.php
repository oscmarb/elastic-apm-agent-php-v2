<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class KubernetesNode implements \JsonSerializable
{
    public function __construct(private ?string $name)
    {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}