<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Processor;

interface Processor
{
    public function __invoke(array $events): array;
}