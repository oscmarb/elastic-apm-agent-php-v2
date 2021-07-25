<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Error;

use Oscmarb\ElasticApm\Test\Common\StackTrace;

class ErrorException implements \JsonSerializable
{
    public function __construct(
        private string|int|null $code,
        private ?bool $handled,
        private ?string $message,
        private ?string $module,
        private ?StackTrace $stackTrace,
        private ?string $type
    ) {
    }

    public function code(): int|string|null
    {
        return $this->code;
    }

    public function handled(): ?bool
    {
        return $this->handled;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function module(): ?string
    {
        return $this->module;
    }

    public function stackTrace(): ?StackTrace
    {
        return $this->stackTrace;
    }

    public function type(): ?string
    {
        return $this->type;
    }

    public function jsonSerialize(): array
    {
        return [
            'code' => $this->code,
            'handled' => $this->handled,
            'message' => $this->message,
            'module' => $this->module,
            'stack_trace' => $this->stackTrace,
            'type' => $this->type,
        ];
    }
}