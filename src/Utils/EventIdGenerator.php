<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Utils;

class EventIdGenerator
{
    public static function random(): string
    {
        return Cryptography::generateRandomBitsInHex(128);
    }
}