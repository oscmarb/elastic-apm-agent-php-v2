<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event\Transaction;

class Context implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [];
    }
}