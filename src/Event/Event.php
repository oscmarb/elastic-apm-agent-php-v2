<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event;

use Oscmarb\ElasticApm\Utils\EventIdGenerator;

abstract class Event implements \JsonSerializable
{
    public function __construct(private ?string $id, private ?string $traceId, private ?string $parentId)
    {
        $this->id ??= EventIdGenerator::random();
        $this->traceId ??= EventIdGenerator::random();
    }

    public function id(): ?string
    {
        return $this->id;
    }

    public function traceId(): ?string
    {
        return $this->traceId;
    }

    public function parentId(): ?string
    {
        return $this->parentId;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'trace_id' => $this->traceId,
            'parent_id' => $this->parentId,
        ];
    }
}