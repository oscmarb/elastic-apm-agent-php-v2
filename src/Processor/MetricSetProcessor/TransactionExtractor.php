<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Processor\MetricSetProcessor;

use Oscmarb\ElasticApm\Event\Event;
use Oscmarb\ElasticApm\Event\Transaction\Transaction;

class TransactionExtractor
{
    /**
     * @param array<Event> $events
     *
     * @return array<Transaction>
     */
    public function extract(array $events): array
    {
        return \array_filter($events, static fn(Event $event) => $event instanceof Transaction);
    }
}