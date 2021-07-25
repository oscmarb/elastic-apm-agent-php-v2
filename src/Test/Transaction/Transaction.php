<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Transaction;

use Oscmarb\ElasticApm\Test\Common\Marks;
use Oscmarb\ElasticApm\Test\Common\Outcome;
use Oscmarb\ElasticApm\Test\Common\SpanCount;

class Transaction implements \JsonSerializable
{
    public function __construct(
        private ?TransactionContext $context,
        private float $duration,
        private string $id,
        private Marks $marks,
        private ?string $name,
        private ?Outcome $outcome,
        private ?string $parentId,
        private ?string $result,
        private ?float $sampleRate,
        private ?bool $sampled,
        private SpanCount $spanCount,
        private ?int $timestamp,
        private string $traceId,
        private string $type
    ) {
    }

    public function context(): ?TransactionContext
    {
        return $this->context;
    }

    public function duration(): float
    {
        return $this->duration;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function marks(): Marks
    {
        return $this->marks;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function outcome(): ?Outcome
    {
        return $this->outcome;
    }

    public function parentId(): ?string
    {
        return $this->parentId;
    }

    public function result(): ?string
    {
        return $this->result;
    }

    public function sampleRate(): ?float
    {
        return $this->sampleRate;
    }

    public function sampled(): ?bool
    {
        return $this->sampled;
    }

    public function spanCount(): SpanCount
    {
        return $this->spanCount;
    }

    public function timestamp(): ?int
    {
        return $this->timestamp;
    }

    public function traceId(): string
    {
        return $this->traceId;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'context' => $this->context,
            'duration' => $this->duration,
            'id' => $this->id,
            'marks' => $this->marks,
            'name' => $this->name,
            'outcome' => $this->outcome,
            'parentId' => $this->parentId,
            'result' => $this->result,
            'sampleRate' => $this->sampleRate,
            'sampled' => $this->sampled,
            'spanCount' => $this->spanCount,
            'timestamp' => $this->timestamp,
            'traceId' => $this->traceId,
            'type' => $this->type,
        ];
    }
}