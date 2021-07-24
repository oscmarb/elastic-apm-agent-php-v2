<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event;

use Oscmarb\ElasticApm\Utils\StopWatch\StopWatch;
use Oscmarb\ElasticApm\Utils\TimestampGenerator;

class Span extends Event
{
    private int $timestamp;
    private float $duration;
    private StopWatch $stopWatch;

    public function __construct(
        private string $name,
        private string $type,
        private string $transactionId,
        private ?string $subtype,
        ?string $id,
        ?string $traceId,
        ?string $parentId
    ) {
        parent::__construct($id, $traceId, $parentId);

        $this->timestamp = TimestampGenerator::now();

        $this->stopWatch = new StopWatch();
        $this->stopWatch->start();
    }

    public function stop(): void
    {
        $this->stopWatch->stop();

        $this->duration = $this->stopWatch->duration();
    }

    public function type(): string
    {
        return $this->type;
    }

    public function subtype(): ?string
    {
        return $this->subtype;
    }

    public function timestamp(): int
    {
        return $this->timestamp;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function transactionId(): string
    {
        return $this->transactionId;
    }

    public function jsonSerialize(): array
    {
        return [
            'span' => \array_merge(
                parent::jsonSerialize(),
                [
                    'name' => $this->name,
                    'transaction_id' => $this->transactionId,
                    'type' => $this->type,
                    'subtype' => $this->subtype,
                    'timestamp' => $this->timestamp,
                    'duration' => $this->duration,
                ]
            ),
        ];
    }
}