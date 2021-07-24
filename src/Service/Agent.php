<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Service;

class Agent implements \JsonSerializable
{
    public const NAME = 'oscmarb/elastic-apm-agent-php';
    public const VERSION = '1.0.0';

    public static function discover(): self
    {
        return new self(self::NAME, self::VERSION);
    }

    public function __construct(private string $name, private string $version)
    {
    }

    public function name(): string
    {
        return $this->name;
    }

    public function version(): string
    {
        return $this->version;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'version' => $this->version,
        ];
    }
}