<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\MetricSet;

use Oscmarb\ElasticApm\Utils\Collection;

class Samples implements \JsonSerializable
{
    private Collection $collection;

    public static function from(array $samples): self
    {
        return new self($samples);
    }

    public function __construct(array $samples)
    {
        $this->collection = Collection::create($samples);
    }

    public function add(string $name, float $value): self
    {
        $this->collection->add(new Sample($name, $value));

        return $this;
    }

    public function jsonSerialize(): array
    {
        $rawSamples = [];

        /** @var Sample $sample */
        foreach ($this->collection->toArray() as $sample) {
            $rawSamples = \array_merge($rawSamples, $sample->jsonSerialize());
        }

        return $rawSamples;
    }
}