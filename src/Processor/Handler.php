<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Processor;

use Oscmarb\ElasticApm\Configuration\Configuration;
use Oscmarb\ElasticApm\Processor\MetricSetProcessor\MetricSetProcessor;
use Oscmarb\ElasticApm\Processor\MetricSetProcessor\TransactionExtractor;

class Handler
{
    /** @var array<Processor> */
    private array $processors;

    public function __construct(Processor ...$processors)
    {
        $this->processors = $processors;
    }

    public static function create(Configuration $configuration): self
    {
        $processors = [];

        if (true === $configuration->metricSet()) {
            $processors[] = new MetricSetProcessor(
                new TransactionExtractor()
            );
        }

        return new self(...$processors);
    }

    public function execute(array $events): array
    {
        foreach ($this->processors as $processor) {
            $events = $processor($events);
        }

        return $events;
    }
}