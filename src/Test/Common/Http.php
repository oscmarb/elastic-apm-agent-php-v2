<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Http implements \JsonSerializable
{
    public function __construct(
        private ?string $method,
        private ?Response $response,
        private ?int $statusCode,
        private ?string $url
    ) {
    }

    public function method(): ?string
    {
        return $this->method;
    }

    public function response(): ?Response
    {
        return $this->response;
    }

    public function statusCode(): ?int
    {
        return $this->statusCode;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function jsonSerialize()
    {
        return [
            'method' => $this->method,
            'response' => $this->response,
            'status_code' => $this->statusCode,
            'url' => $this->url,
        ];
    }
}