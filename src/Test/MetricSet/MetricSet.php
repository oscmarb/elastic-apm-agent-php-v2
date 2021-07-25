<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\MetricSet;

use Oscmarb\ElasticApm\MetricSet\SpanMetric;
use Oscmarb\ElasticApm\Test\Common\Samples;
use Oscmarb\ElasticApm\Test\Common\Tags;

class MetricSet implements \JsonSerializable
{
    public function __construct(
        private Samples $samples,
        private ?SpanMetric $span,
        private ?Tags $tags,
        private ?int $timestamp,
        private ?TransactionMetric $transaction
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'samples' => $this->samples,
            'span' => $this->span,
            'tags' => $this->tags,
            'timestamp' => $this->timestamp,
            'transaction' => $this->transaction,
        ];
    }
}