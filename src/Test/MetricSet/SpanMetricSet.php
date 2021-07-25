<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\MetricSet;

class SpanMetricSet implements \JsonSerializable
{
    public function __construct(private ?string $subtype, private ?string $type)
    {
    }

    public function subtype(): ?string
    {
        return $this->subtype;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function jsonSerialize()
    {
        return [
            'subtype' => $this->subtype,
            'type' => $this->type,
        ];
    }
}