<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Error;

class Error implements \JsonSerializable
{
    public function __construct(
        private ?ErrorContext $context,
        private ?string $culprit,
        private ?ErrorException $exception,
        private string $id,
        private ?Log $log,
        private ?string $parentId,
        private ?int $timestamp,
        private ?string $traceId,
        private ?TransactionError $transaction,
        private ?string $transactionId
    )
    {
    }

    public function jsonSerialize():array
    {
        return [];
    }
}