<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Test\Common;

class Samples implements \JsonSerializable
{
    private array $samples = [];

    public function add(Sample $sample): void
    {
        $this->samples[] = $sample;
    }

    public function samples(): array
    {
        return $this->samples;
    }

    public function jsonSerialize(): array
    {
        return \array_reduce(
            $this->samples,
            static fn(array $carry, Sample $sample) => \array_merge(
                $carry,
                json_decode(\json_encode($sample, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR)
            ),
            []
        );
    }
}