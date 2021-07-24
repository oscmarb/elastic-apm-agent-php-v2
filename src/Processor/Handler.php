<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Processor;

use Oscmarb\ElasticApm\Configuration\ApmConfiguration;

class Handler
{
    /** @var array<Processor> */
    private array $processors;

    public function __construct(Processor ...$processors)
    {
        $this->processors = $processors;
    }

    public static function create(ApmConfiguration $configuration): self
    {
        $processors = [];

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