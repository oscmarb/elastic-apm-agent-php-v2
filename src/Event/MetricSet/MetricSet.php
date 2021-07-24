<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Event;

class MetricSet implements \JsonSerializable
{
    private array $samples;

    public function __construct(
        private $timestamp,
        private TransactionMetric $transaction,
        Sample ...$samples
    ) {
        $this->samples = $samples;
    }


}