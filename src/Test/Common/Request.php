<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Request implements \JsonSerializable
{
    public function __construct(
        private ?string $body,
        private ?Cookies $cookies,
        private ?Headers $headers,
        private ?string $httpVersion,
        private string $method,
        private ?Socket $socket
    ) {
    }

    public function body(): ?string
    {
        return $this->body;
    }

    public function cookies(): ?Cookies
    {
        return $this->cookies;
    }

    public function headers(): ?Headers
    {
        return $this->headers;
    }

    public function httpVersion(): ?string
    {
        return $this->httpVersion;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function socket(): ?Socket
    {
        return $this->socket;
    }

    public function jsonSerialize(): array
    {
        return [
            'body' => $this->body,
            'cookies' => $this->cookies,
            'headers' => $this->headers,
            'http_version' => $this->httpVersion,
            'method' => $this->method,
            'socket' => $this->socket,
        ];
    }
}