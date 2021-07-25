<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm;

use Oscmarb\ElasticApm\Configuration\Configuration;
use Oscmarb\ElasticApm\Event\Transaction\Context;
use Oscmarb\ElasticApm\Pool\EventPool;
use Oscmarb\ElasticApm\Processor\Handler;
use Oscmarb\ElasticApm\Reporter\Reporter;
use Oscmarb\ElasticApm\Service\Metadata;

class ElasticApmTracer
{
    private Handler $handler;
    private Metadata $metadata;
    private ApmContext $context;

    public function __construct(
        private Configuration $configuration,
        private Reporter $reporter,
        private EventPool $eventPool
    ) {
        $this->handler = Handler::create($this->configuration);
        $this->metadata = Metadata::create($this->configuration);
        $this->context = ApmContext::default();
    }

    public function isActive(): bool
    {
        return $this->configuration->isActive();
    }

    public function startTransaction(string $name, string $type, ?Context $context = null): string
    {
        if (false === $this->isActive()) {
            return '';
        }

        return $this->eventPool->startTransaction($name, $type, $context);
    }

    public function stopTransaction(string $id, string $result): void
    {
        if (false === $this->isActive()) {
            return;
        }

        $this->eventPool->stopTransaction($id, $result);
    }

    public function startSpan(string $name, string $type, ?string $subtype = null): string
    {
        if (false === $this->isActive()) {
            return '';
        }

        return $this->eventPool->startSpan($name, $type, $subtype);
    }

    public function stopSpan(string $id): void
    {
        if (false === $this->isActive()) {
            return;
        }

        $this->eventPool->stopSpan($id);
    }

    public function flush(): void
    {
        if (false === $this->isActive()) {
            return;
        }

        $events = $this->eventPool->pullEvents();

        if (true === empty($events)) {
            return;
        }

        $events = [$this->metadata, ...$events, ...$this->handler->execute($events)];

        $this->reporter->report($events);
    }
}