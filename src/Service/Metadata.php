<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Service;

use Oscmarb\ElasticApm\Configuration\ApmConfiguration;

class Metadata implements \JsonSerializable
{
    public function __construct(private Service $service)
    {
    }

    public static function create(ApmConfiguration $configuration)
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