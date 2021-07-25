<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Page implements \JsonSerializable
{
    public function __construct(private ?string $referer, private ?string $url)
    {
    }

    public function referer(): ?string
    {
        return $this->referer;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function jsonSerialize(): array
    {
        return [
            'referer' => $this->referer,
            'url' => $this->url,
        ];
    }
}