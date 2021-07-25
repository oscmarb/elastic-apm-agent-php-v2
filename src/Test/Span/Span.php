<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Span;

use Oscmarb\ElasticApm\Test\Common\StackTrace;

class Span implements \JsonSerializable
{
    public function __construct(
        private ?string $action,
        private ?array $childIds,
        private SpanContext $context,
        private ?float $duration,
        private string $id,
        private string $name,
        private string $parentId,
        private ?float $sampleRate,
        private ?StackTrace $stackTrace,
        private ?int $start,
        private ?string $subtype,
        private ?bool $sync,
        private ?int $timestamp,
        private string $traceId,
        private ?string $transactionId,
        private string $type
    ) {
    }

    public function action(): ?string
    {
        return $this->action;
    }

    public function childIds(): ?array
    {
        return $this->childIds;
    }

    public function context(): SpanContext
    {
        return $this->context;
    }

    public function duration(): ?float
    {
        return $this->duration;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parentId(): string
    {
        return $this->parentId;
    }

    public function sampleRate(): ?float
    {
        return $this->sampleRate;
    }

    public function stackTrace(): ?StackTrace
    {
        return $this->stackTrace;
    }

    public function start(): ?int
    {
        return $this->start;
    }

    public function subtype(): ?string
    {
        return $this->subtype;
    }

    public function sync(): ?bool
    {
        return $this->sync;
    }

    public function timestamp(): ?int
    {
        return $this->timestamp;
    }

    public function traceId(): string
    {
        return $this->traceId;
    }

    public function transactionId(): ?string
    {
        return $this->transactionId;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'span' => [
                'action' => $this->action,
                'child_ids' => $this->childIds,
                'context' => $this->context,
                'duration' => $this->duration,
                'id' => $this->id,
                'name' => $this->name,
                'parent_id' => $this->parentId,
                'sample_rate' => $this->sampleRate,
                'stack_trace' => $this->stackTrace,
                'start' => $this->start,
                'subtype' => $this->subtype,
                'sync' => $this->sync,
                'timestamp' => $this->timestamp,
                'trace_id' => $this->traceId,
                'transaction_id' => $this->transactionId,
                'type' => $this->type,
            ],
        ];
    }
}