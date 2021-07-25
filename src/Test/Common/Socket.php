<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Socket implements \JsonSerializable
{
    public function __construct(private ?bool $encrypted, private ?string $remoteAddress)
    {
    }

    public function encrypted(): ?bool
    {
        return $this->encrypted;
    }

    public function remoteAddress(): ?string
    {
        return $this->remoteAddress;
    }

    public function jsonSerialize()
    {
        return [
            'encrypted' => $this->encrypted,
            'remote_address' => $this->remoteAddress
        ];
    }
}