<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Pool;

use Oscmarb\ElasticApm\Event\Transaction\Context;

interface EventPool
{
    public function startTransaction(string $name, string $type, ?Context $context): string;

    public function stopTransaction(string $id, string $result): void;

    public function startSpan(string $name, string $type, ?string $subtype): string;

    public function stopSpan(string $id): void;

    public function pullEvents(): array;
}