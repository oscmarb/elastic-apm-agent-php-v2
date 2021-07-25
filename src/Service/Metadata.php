<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Service;

use Oscmarb\ElasticApm\Configuration\Configuration;

class Metadata implements \JsonSerializable
{
    public function __construct(private Service $service)
    {
    }

    public static function create(Configuration $configuration): self
    {
        return new self(Service::create($configuration));
    }

    public function jsonSerialize(): array
    {
        return [
            'metadata' => [
                'service' => $this->service->jsonSerialize(),
            ],
        ];
    }
}