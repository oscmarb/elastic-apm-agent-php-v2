<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\MetricSet;

class TransactionMetric implements \JsonSerializable
{
    public function __construct(private ?string $name, private ?string $type)
    {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
        ];
    }
}