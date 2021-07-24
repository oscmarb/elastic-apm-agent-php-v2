<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event;

use Oscmarb\ElasticApm\Exception\TransactionIsNotCompletedException;
use Oscmarb\ElasticApm\Utils\StopWatch\StopWatch;
use Oscmarb\ElasticApm\Utils\TimestampGenerator;

class Transaction extends Event
{
    private ?float $duration = null;
    private ?string $result = null;
    private ?int $timestamp;
    private SpanCount $spanCount;
    private StopWatch $stopWatch;

    function __construct(
        private ?string $id,
        private string $name,
        private string $type,
        private ?Context $context = null,
        ?string $traceId = null,
        ?string $parentId = null,
    ) {
        $this->spanCount = new SpanCount();
        $this->timestamp = TimestampGenerator::now();
        $this->stopWatch = new StopWatch();

        $this->stopWatch->start();

        parent::__construct($id, $traceId, $parentId);
    }

    public function stop(?string $result): void
    {
        $this->stopWatch->stop();

        $this->result = $result;
        $this->duration = $this->stopWatch->duration();
    }

    public function id(): string
    {
        return $this->id;
    }

    public function duration(): float
    {
        return $this->duration;
    }

    public function spanCount(): SpanCount
    {
        return $this->spanCount;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function result(): ?string
    {
        return $this->result;
    }

    public function timestamp(): ?int
    {
        return $this->timestamp;
    }

    public function context(): ?Context
    {
        return $this->context;
    }

    public function isCompleted(): bool
    {
        return $this->duration !== null;
    }

    public function jsonSerialize(): array
    {
        if (false === $this->isCompleted()) {
            throw new TransactionIsNotCompletedException();
        }

        return [
            'transaction' => array_merge(
                parent::jsonSerialize(),
                [
                    'id' => $this->id,
                    'duration' => $this->duration,
                    'span_count' => $this->spanCount->toPrimitives(),
                    'type' => $this->type,
                    'name' => $this->name,
                    'result' => $this->result,
                    'timestamp' => $this->timestamp,
                    'context' => $this->context?->toPrimitives(),
                ]
            ),
        ];
    }
}