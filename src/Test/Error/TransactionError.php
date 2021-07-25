<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Error;

class TransactionError implements \JsonSerializable
{
    public function __construct(private ?bool $sampled, private ?string $type)
    {
    }

    public function sampled(): ?bool
    {
        return $this->sampled;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'sampled' => $this->sampled,
            'type' => $this->type,
        ];
    }
}