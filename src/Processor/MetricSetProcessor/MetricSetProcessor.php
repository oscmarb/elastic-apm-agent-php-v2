<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Processor\MetricSetProcessor;

use Oscmarb\ElasticApm\Event\Event;
use Oscmarb\ElasticApm\Event\Span\Span;
use Oscmarb\ElasticApm\Event\Transaction\Transaction;
use Oscmarb\ElasticApm\MetricSet\MetricSet;
use Oscmarb\ElasticApm\MetricSet\Sample;
use Oscmarb\ElasticApm\MetricSet\Samples;
use Oscmarb\ElasticApm\MetricSet\SpanMetric;
use Oscmarb\ElasticApm\MetricSet\TransactionMetric;
use Oscmarb\ElasticApm\Processor\Processor;

class MetricSetProcessor implements Processor
{
    public function __construct(private TransactionExtractor $transactionExtractor)
    {
    }

    public function __invoke(array $events): array
    {
        $metrics = [];
        $transactions = $this->transactionExtractor->extract($events);
        $indexedSpansByTransactionId = $this->indexEventsByTransactionId($events);

        foreach ($transactions as $transaction) {
            $spans = $indexedSpansByTransactionId[$transaction->id()] ?? [];

            $metrics = [...$metrics, ...$this->executeByTransaction($transaction, $spans)];
        }

        return $metrics;
    }


    /**
     * @param Transaction $transaction
     * @param array<Span> $spans
     *
     * @return MetricSet[]
     */
    private function executeByTransaction(Transaction $transaction, array $spans): array
    {
        $metrics = [
            new MetricSet(
                $transaction->timestamp(),
                Samples::from(
                    [
                        new Sample('transaction.duration.count', 1),
                        new Sample('transaction.duration.sum.us', $transaction->duration()),
                        new Sample('transaction.breakdown.count', 1),
                    ]
                ),
                new TransactionMetric(
                    $transaction->name(),
                    $transaction->type()
                ),
            ),
        ];

        foreach ($spans as $span) {
            $metrics[] = new MetricSet(
                $transaction->timestamp(),
                Samples::from(
                    [
                        new Sample('span.self_time.count', 1),
                        new Sample('span.self_time.sum.us', $span->duration()),
                    ]
                ),
                new TransactionMetric(
                    $transaction->name(),
                    $transaction->type()
                ),
                new SpanMetric(
                    $span->type(),
                    $span->subtype()
                )
            );
        }

        return $metrics;
    }

    /**
     * @param array<Event> $events
     * @return array<string, array<Event>>
     */
    private function indexEventsByTransactionId(array $events): array
    {
        $indexedEvents = [];

        foreach ($events as $event) {
            $transactionId = $event->transactionId();

            if (false === isset($indexedEvents[$transactionId])) {
                $indexedEvents[$transactionId] = [];
            }

            $indexedEvents[$transactionId][] = $event;
        }

        return $indexedEvents;
    }
}