<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\MetricSet;

class SpanMetric implements \JsonSerializable
{
    public function __construct(
        private string $type,
        private ?string $subtype
    ) {
    }

    public function type(): string
    {
        return $this->type;
    }

    public function subtype(): ?string
    {
        return $this->subtype;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
            'subtype' => $this->subtype,
        ];
    }
}