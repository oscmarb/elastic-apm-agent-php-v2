<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class SpanCount implements \JsonSerializable
{
    public function __construct(private ?int $dropped, private ?int $started)
    {
    }

    public function dropped(): ?int
    {
        return $this->dropped;
    }

    public function started(): ?int
    {
        return $this->started;
    }

    public function jsonSerialize(): array
    {
        return [
            'dropped' => $this->dropped,
            'started' => $this->started,
        ];
    }
}