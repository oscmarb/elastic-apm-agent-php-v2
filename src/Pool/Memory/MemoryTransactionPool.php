<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Pool\Memory;

use Oscmarb\ElasticApm\Event\Transaction\Context;
use Oscmarb\ElasticApm\Event\Transaction\Transaction;
use Oscmarb\ElasticApm\Pool\Exception\TransactionAlreadyStoppedException;
use Oscmarb\ElasticApm\Pool\Exception\TransactionNotFoundException;
use Oscmarb\ElasticApm\Utils\EventIdGenerator;

class MemoryTransactionPool
{
    /** @var array<string,Transaction> */
    private array $finishedTransactions = [];

    /** @var array<string,Transaction> */
    private array $unfinishedTransactions = [];

    public function startTransaction(
        string $name,
        string $type,
        ?Context $context,
        ?string $traceId,
        ?string $parentId
    ): string {
        $id = EventIdGenerator::random();

        $transaction = new Transaction($id, $name, $type, $context, $traceId, $parentId);
        $this->unfinishedTransactions[$id] = $transaction;

        return $id;
    }

    public function stopTransaction(string $id, string $result): void
    {
        $transaction = $this->unfinishedTransactions[$id] ?? null;

        if (null === $transaction) {
            if (true === $this->isTransactionFinished($id)) {
                throw new TransactionAlreadyStoppedException();
            }

            throw new TransactionNotFoundException();
        }

        $transaction->stop($result);

        unset($this->unfinishedTransactions[$id]);
        $this->finishedTransactions[$id] = $transaction;
    }

    /**
     * @return array<Transaction>
     */
    public function pullFinishedTransactions(): array
    {
        $finishedTransactions = $this->finishedTransactions;
        $this->finishedTransactions = [];

        return \array_values($finishedTransactions);
    }

    public function getLastUnfinishedTransaction(): ?Transaction
    {
        return \array_values($this->unfinishedTransactions)[0] ?? null;
    }

    private function isTransactionFinished(string $id): bool
    {
        return array_key_exists($id, $this->finishedTransactions);
    }
}