<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Service;

use Oscmarb\ElasticApm\Configuration\ApmConfiguration;

class Service implements \JsonSerializable
{
    public static function create(ApmConfiguration $configuration): self
    {
        return new self($configuration->appName(), Agent::discover());
    }

    public function __construct(private string $name, private Agent $agent)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function agent(): Agent
    {
        return $this->agent;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'agent' => $this->agent->jsonSerialize(),
        ];
    }
}