<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Error;

use Oscmarb\ElasticApm\Test\Common\StackTrace;

class Log implements \JsonSerializable
{
    public function __construct(
        private ?string $level,
        private ?string $loggerName,
        private string $message,
        private ?string $paramMessage,
        private StackTrace $stackTrace
    ) {
    }

    public function level(): ?string
    {
        return $this->level;
    }

    public function loggerName(): ?string
    {
        return $this->loggerName;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function paramMessage(): ?string
    {
        return $this->paramMessage;
    }

    public function stackTrace(): StackTrace
    {
        return $this->stackTrace;
    }

    public function jsonSerialize(): array
    {
        return [
            'level' => $this->level,
            'loggerName' => $this->loggerName,
            'message' => $this->message,
            'paramMessage' => $this->paramMessage,
            'stackTrace' => $this->stackTrace,
        ];
    }
}