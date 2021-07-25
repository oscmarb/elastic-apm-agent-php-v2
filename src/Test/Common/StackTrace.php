<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class StackTrace implements \JsonSerializable
{
    public function from(array $items): self
    {
        return new self($items);
    }

    public function __construct(private array $items)
    {
    }

    public function add(Trace $trace): void
    {
        $this->items[] = $trace;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return \array_map(static fn(Trace $trace) => $trace->jsonSerialize(), $this->items);
    }
}