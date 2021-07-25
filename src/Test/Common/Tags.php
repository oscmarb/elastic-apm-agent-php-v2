<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Tags implements \JsonSerializable
{
    public static function from(array $tags): self
    {
        return new self($tags);
    }

    public function __construct(private array $tags)
    {
    }

    public function tags(): array
    {
        return $this->tags;
    }

    public function add(string $name, string $value): void
    {
        $this->tags[$name] = $value;
    }

    public function jsonSerialize(): array
    {
        return $this->tags;
    }
}