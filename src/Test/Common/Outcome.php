<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Outcome implements \JsonSerializable
{
    public static function success(): self
    {
        return new self('success');
    }

    public static function failure(): self
    {
        return new self('failure');
    }

    public static function unknown(): self
    {
        return new self('unknown');
    }

    private function __construct(private string $outcome)
    {
    }

    public function jsonSerialize()
    {
        return $this->outcome;
    }
}