<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Metadata;

class KubernetesPod implements \JsonSerializable
{
    public function __construct(private ?string $name, private ?string $uid)
    {
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function uid(): ?string
    {
        return $this->uid;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'uid' => $this->uid,
        ];
    }
}