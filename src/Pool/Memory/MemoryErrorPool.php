<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Pool\Memory;

class MemoryErrorPool
{
    public function pullByTransactionsIds(array $transactionsIds): array
    {
        return [];
    }
}