<?php

namespace Oscmarb\ElasticApm\Utils;

final class Compressor
{
    public static function gzip(mixed $data): ?string
    {
        self::assert($data);

        $result = gzencode($data, -1, FORCE_GZIP);

        return false === $result ? null : $result;
    }

    private static function assert(mixed $data): void
    {
        if (true === is_string($data) && false === empty($data)) {
            return;
        }

        throw new \Exception('Data is not valid. It must be of type string and contain at least one character.');
    }
}
