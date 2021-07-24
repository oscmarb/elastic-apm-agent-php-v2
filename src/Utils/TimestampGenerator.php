<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Utils;

class TimestampGenerator
{
    public static function now(): int
    {
        return (int)(microtime(true) * 1000000);
    }
}