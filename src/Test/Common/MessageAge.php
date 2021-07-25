<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class MessageAge implements \JsonSerializable
{
    public function __construct(private ?float $ms)
    {
    }

    public function ms(): ?float
    {
        return $this->ms;
    }

    public function jsonSerialize(): array
    {
        return ['ms' => $this->ms];
    }
}