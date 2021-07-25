<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Cookies implements \JsonSerializable
{
    public static function from(array $cookies): self
    {
        return new self($cookies);
    }

    public function __construct(private array $cookies)
    {
    }

    public function cookies(): array
    {
        return $this->cookies;
    }

    public function add(string $name, string $value): void
    {
        $this->cookies[$name] = $value;
    }

    public function jsonSerialize(): array
    {
        return $this->cookies;
    }
}