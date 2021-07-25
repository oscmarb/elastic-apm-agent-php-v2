<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Pool\Memory;

use Oscmarb\ElasticApm\Event\Span\Span;
use Oscmarb\ElasticApm\Pool\Exception\SpanAlreadyStoppedException;
use Oscmarb\ElasticApm\Pool\Exception\SpanNotFoundException;
use Oscmarb\ElasticApm\Utils\EventIdGenerator;

class MemorySpanPool
{
    /** @var array<string,Span> */
    private array $finishedSpans = [];

    /** @var array<string,Span> */
    private array $unfinishedSpans = [];

    public function startSpan(
        string $name,
        string $type,
        ?string $subtype,
        string $transactionId,
        ?string $traceId,
        ?string $parentId
    ): string {
        $id = EventIdGenerator::random();

        $span = new Span($name, $type, $subtype, $transactionId, $id, $traceId, $parentId);
        $this->unfinishedSpans[$id] = $span;

        return $id;
    }

    public function stopSpan(string $id): void
    {
        $span = $this->unfinishedSpans[$id] ?? null;

        if (null === $span) {
            if (true === $this->isSpanFinished($id)) {
                throw new SpanAlreadyStoppedException();
            }

            throw new SpanNotFoundException();
        }

        $span->stop();

        unset($this->unfinishedSpans[$id]);
        $this->finishedSpans[] = $span;
    }

    public function pullByTransactionsIds(array $transactionsIds): array
    {
        $pull = [];
        $finishedSpans = $this->finishedSpans;
        $this->finishedSpans = [];

        foreach ($finishedSpans as $span) {
            if (true === \in_array($span->transactionId(), $transactionsIds, true)) {
                $pull[] = $span;
            } else {
                $this->finishedSpans[] = $span;
            }
        }

        return $pull;
    }

    public function getLastUnfinishedSpan(): ?Span
    {
        return \array_values($this->unfinishedSpans)[0] ?? null;
    }

    private function isSpanFinished(string $id): bool
    {
        return array_key_exists($id, $this->finishedSpans);
    }
}