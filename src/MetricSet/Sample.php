<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\MetricSet;

class Sample implements \JsonSerializable
{
    public function __construct(private string $name, private float $value)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): float
    {
        return $this->value;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->name => ['value' => $this->value],
        ];
    }
}