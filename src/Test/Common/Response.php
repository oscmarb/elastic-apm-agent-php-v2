<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Response implements \JsonSerializable
{
    public function __construct(
        private ?int $decodedBodySize,
        private ?int $encodedBodySize,
        private ?bool $finished,
        private ?Headers $headers,
        private ?bool $headersSent,
        private ?int $statusCode,
        private ?int $transferSize,
    ) {
    }

    public function decodedBodySize(): ?int
    {
        return $this->decodedBodySize;
    }

    public function encodedBodySize(): ?int
    {
        return $this->encodedBodySize;
    }

    public function finished(): ?bool
    {
        return $this->finished;
    }

    public function headers(): ?Headers
    {
        return $this->headers;
    }

    public function headersSent(): ?bool
    {
        return $this->headersSent;
    }

    public function statusCode(): ?int
    {
        return $this->statusCode;
    }

    public function transferSize(): ?int
    {
        return $this->transferSize;
    }

    public function jsonSerialize(): array
    {
        return [
            'decoded_body_size' => $this->decodedBodySize,
            'encoded_body_size' => $this->encodedBodySize,
            'finished' => $this->finished,
            'headers' => $this->headers,
            'headers_sent' => $this->headersSent,
            'status_code' => $this->statusCode,
            'transfer_size' => $this->transferSize,
        ];
    }
}