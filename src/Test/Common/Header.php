<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Header implements \JsonSerializable
{
    public function __construct(
        private string $name,
        private array|string|null $type,
        private string $items
    ) {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function type(): array|string|null
    {
        return $this->type;
    }

    public function items(): string
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return [
            $this->name => [
                'type' => $this->type,
                'items' => $this->items,
            ],
        ];
    }
}