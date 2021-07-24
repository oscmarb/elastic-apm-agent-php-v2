<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Pool\Memory;

use Oscmarb\ElasticApm\Event\Context;
use Oscmarb\ElasticApm\Event\Event;
use Oscmarb\ElasticApm\Event\Transaction;
use Oscmarb\ElasticApm\Pool\EventPool;
use Oscmarb\ElasticApm\Pool\Exception\SpanNeedsStartedTransactionIdToCanBeCreatedException;

class MemoryEventPool implements EventPool
{
    private MemorySpanPool $spanPool;
    private MemoryErrorPool $errorPool;
    private MemoryTransactionPool $transactionPool;

    public function __construct()
    {
        $this->transactionPool = new MemoryTransactionPool();
        $this->spanPool = new MemorySpanPool();
        $this->errorPool = new MemoryErrorPool();
    }

    public function startTransaction(string $name, string $type, ?Context $context): string
    {
        $unfinishedEvent = $this->getLastUnfinishedEvent();

        return $this->transactionPool->startTransaction(
            $name,
            $type,
            $context,
            $unfinishedEvent?->traceId(),
            $unfinishedEvent?->id()
        );
    }

    public function stopTransaction(string $id, string $result): void
    {
        $this->transactionPool->stopTransaction($id, $result);
    }

    public function startSpan(string $name, string $type, ?string $subtype): string
    {
        $transaction = $this->transactionPool->getLastUnfinishedTransaction();

        if (null === $transaction) {
            throw new SpanNeedsStartedTransactionIdToCanBeCreatedException();
        }

        $unfinishedEvent = $this->getLastUnfinishedEvent();

        return $this->spanPool->startSpan(
            $name,
            $type,
            $subtype,
            $transaction->id(),
            $unfinishedEvent?->traceId(),
            $unfinishedEvent?->id()
        );
    }

    public function stopSpan(string $id): void
    {
        $this->spanPool->stopSpan($id);
    }

    public function pullEvents(): array
    {
        $transactions = $this->transactionPool->pullFinishedTransactions();
        $transactionsIds = \array_map(static fn(Transaction $transaction) => $transaction->id(), $transactions);

        $spans = $this->spanPool->pullByTransactionsIds($transactionsIds);
        $errors = $this->errorPool->pullByTransactionsIds($transactionsIds);

        return [...$transactions, ...$spans, ...$errors];
    }

    private function getLastUnfinishedEvent(): ?Event
    {
        $lastTransaction = $this->transactionPool->getLastUnfinishedTransaction();

        if (null === $lastTransaction) {
            return null;
        }

        $lastSpan = $this->spanPool->getLastUnfinishedSpan();

        if (null === $lastSpan) {
            return $lastTransaction;
        }

        return $lastTransaction->timestamp() > $lastSpan->timestamp() ? $lastTransaction : $lastSpan;
    }
}