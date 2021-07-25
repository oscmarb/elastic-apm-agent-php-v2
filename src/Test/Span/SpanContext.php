<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Span;

use Oscmarb\ElasticApm\Test\Common\Db;
use Oscmarb\ElasticApm\Test\Common\Destination;
use Oscmarb\ElasticApm\Test\Common\Http;
use Oscmarb\ElasticApm\Test\Common\Message;
use Oscmarb\ElasticApm\Test\Common\Service;
use Oscmarb\ElasticApm\Test\Common\Tags;

class SpanContext implements \JsonSerializable
{
    public function __construct(
        private ?Db $db,
        private ?Destination $destination,
        private ?Http $http,
        private ?Message $message,
        private ?Service $service,
        private ?Tags $tags
    ) {
    }

    public function db(): ?Db
    {
        return $this->db;
    }

    public function destination(): ?Destination
    {
        return $this->destination;
    }

    public function http(): ?Http
    {
        return $this->http;
    }

    public function message(): ?Message
    {
        return $this->message;
    }

    public function service(): ?Service
    {
        return $this->service;
    }

    public function tags(): ?Tags
    {
        return $this->tags;
    }

    public function jsonSerialize(): array
    {
        return [
            'db' => $this->db,
            'destination' => $this->destination,
            'http' => $this->http,
            'message' => $this->message,
            'service' => $this->service,
            'tags' => $this->tags,
        ];
    }
}