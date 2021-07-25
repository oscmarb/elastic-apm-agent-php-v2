<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event\Span;

use Oscmarb\ElasticApm\Event\Event;
use Oscmarb\ElasticApm\Utils\StopWatch\StopWatch;
use Oscmarb\ElasticApm\Utils\TimestampEpochGenerator;

class Span extends Event
{
    private int $timestamp;
    private float $duration;
    private StopWatch $stopWatch;

    public function __construct(
        private string $name,
        private string $type,
        private ?string $subtype,
        string $transactionId,
        ?string $id,
        ?string $traceId,
        ?string $parentId
    ) {
        parent::__construct($id, $traceId, $parentId, $transactionId);

        $this->timestamp = TimestampEpochGenerator::now();

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

    public function duration(): float
    {
        return $this->duration;
    }

    public function jsonSerialize(): array
    {
        return [
            'span' => \array_merge(
                parent::jsonSerialize(),
                [
                    'name' => $this->name,
                    'type' => $this->type,
                    'subtype' => $this->subtype,
                    'timestamp' => $this->timestamp,
                    'duration' => $this->duration,
                ]
            ),
        ];
    }
}