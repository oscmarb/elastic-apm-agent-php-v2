<?php

namespace Oscmarb\ElasticApm\Utils;

final class Cryptography
{
    public static function generateRandomBitsInHex(int $bits): string
    {
        return ($length = $bits / 8) < 1
            ? throw new \RuntimeException('Length must be greater than 0.')
            : bin2hex(random_bytes($length));
    }
}
