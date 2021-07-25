<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Marks implements \JsonSerializable
{
    public static function from(array $marks): self
    {
        return new self($marks);
    }

    public function __construct(private array $marks)
    {
    }

    public function marks(): array
    {
        return $this->marks;
    }

    public function add(string $name, string $value): void
    {
        $this->marks[$name] = $value;
    }

    public function jsonSerialize(): array
    {
        return $this->marks;
    }
}