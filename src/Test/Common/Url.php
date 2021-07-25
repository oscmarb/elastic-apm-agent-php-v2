<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Url implements \JsonSerializable
{
    public function __construct(
        private ?string $full,
        private ?string $hash,
        private ?string $hostname,
        private ?string $pathname,
        private int|string|null $port,
        private ?string $protocol,
        private ?string $raw,
        private ?string $search,
    ) {
    }

    public function full(): ?string
    {
        return $this->full;
    }

    public function hash(): ?string
    {
        return $this->hash;
    }

    public function hostname(): ?string
    {
        return $this->hostname;
    }

    public function pathname(): ?string
    {
        return $this->pathname;
    }

    public function port(): int|string|null
    {
        return $this->port;
    }

    public function protocol(): ?string
    {
        return $this->protocol;
    }

    public function raw(): ?string
    {
        return $this->raw;
    }

    public function search(): ?string
    {
        return $this->search;
    }

    public function jsonSerialize(): array
    {
        return [
            'full' => $this->full,
            'hash' => $this->hash,
            'hostname' => $this->hostname,
            'pathname' => $this->pathname,
            'port' => $this->port,
            'protocol' => $this->protocol,
            'raw' => $this->raw,
            'search' => $this->search,
        ];
    }


}