<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Message implements \JsonSerializable
{
    public function __construct(
        private ?MessageAge $age,
        private ?string $body,
        private ?Headers $headers,
        private ?MessageQueue $queue
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'age' => $this->age,
            'body' => $this->body,
            'headers' => $this->headers,
            'queue' => $this->queue,
        ];
    }
}