<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Headers implements \JsonSerializable
{
    public function __construct(private array $headers)
    {
    }

    public function headers(): array
    {
        return $this->headers;
    }

    public function add(Header $header): void
    {
        $this->headers[] = $header;
    }

    public function jsonSerialize(): array
    {
        return \array_reduce(
            $this->headers,
            static fn(array $carry, Header $header) => \array_merge(
                $carry,
                json_decode(\json_encode($header, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR)
            ),
            []
        );
    }
}