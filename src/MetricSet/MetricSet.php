<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\MetricSet;

class MetricSet implements \JsonSerializable
{
    public function __construct(
        private int $timestamp,
        private Samples $samples,
        private TransactionMetric $transaction,
        private ?SpanMetric $span = null
    ) {
    }

    public function timestamp(): int
    {
        return $this->timestamp;
    }

    public function transaction(): TransactionMetric
    {
        return $this->transaction;
    }

    public function span(): ?SpanMetric
    {
        return $this->span;
    }

    public function samples(): Samples
    {
        return $this->samples;
    }

    public function jsonSerialize(): array
    {
        return [
            'metricset' => [
                'timestamp' => $this->timestamp,
                'transaction' => $this->transaction,
                'samples' => $this->samples->jsonSerialize(),
                'span' => $this->span?->jsonSerialize(),
            ],
        ];
    }
}