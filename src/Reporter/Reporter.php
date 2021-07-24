<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Reporter;

interface Reporter
{
    public function report(array $events): void;
}