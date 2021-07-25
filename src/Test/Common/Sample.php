<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Sample implements \JsonSerializable
{
    public function __construct(
        private ?array $counts,
        private ?string $type,
        private ?string $unit,
        private ?float $value,
        private ?array $values
    ) {
    }

    public function counts(): ?array
    {
        return $this->counts;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function unit(): ?string
    {
        return $this->unit;
    }

    public function value(): ?float
    {
        return $this->value;
    }

    public function values(): ?array
    {
        return $this->values;
    }

    public function jsonSerialize(): array
    {
        return [
            'counts' => $this->counts,
            'type' => $this->type,
            'unit' => $this->unit,
            'value' => $this->value,
            'values' => $this->values,
        ];
    }
}