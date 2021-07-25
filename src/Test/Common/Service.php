<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Service implements \JsonSerializable
{
    public function __construct(
        private ?Agent $agent,
        private ?string $environment,
        private ?Framework $framework,
        private ?Language $language,
        private ?string $name,
        private ?Node $node,
        private ?Runtime $runtime,
        private ?string $version
    ) {
    }

    public function agent(): ?Agent
    {
        return $this->agent;
    }

    public function environment(): ?string
    {
        return $this->environment;
    }

    public function framework(): ?Framework
    {
        return $this->framework;
    }

    public function language(): ?Language
    {
        return $this->language;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function node(): ?Node
    {
        return $this->node;
    }

    public function runtime(): ?Runtime
    {
        return $this->runtime;
    }

    public function version(): ?string
    {
        return $this->version;
    }

    public function jsonSerialize(): array
    {
        return [
            'agent' => $this->agent,
            'environment' => $this->environment,
            'framework' => $this->framework,
            'language' => $this->language,
            'name' => $this->name,
            'node' => $this->node,
            'runtime' => $this->runtime,
            'version' => $this->version,
        ];
    }
}