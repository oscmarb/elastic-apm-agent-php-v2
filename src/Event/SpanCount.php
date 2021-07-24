<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event;

class SpanCount
{
    public function __construct(private int $started = 0, private int $dropped = 0)
    {
    }

    public function started(): int
    {
        return $this->started;
    }

    public function dropped(): ?int
    {
        return $this->dropped;
    }

    public function toPrimitives(): array
    {
        return [
            'started' => $this->started,
            'dropped' => $this->dropped,
        ];
    }
}