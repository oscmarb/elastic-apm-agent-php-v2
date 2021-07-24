<?php

namespace Oscmarb\ElasticApm\Utils;

final class NDJson
{
    public static function contentType(): string
    {
        return 'application/x-ndjson';
    }

    public static function convert(array $events): string
    {
        $string = '';

        foreach ($events as $event) {
            $string .= \json_encode($event, JSON_THROW_ON_ERROR).\PHP_EOL;
        }

        return $string;
    }
}
