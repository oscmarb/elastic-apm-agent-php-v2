<?php

declare(strict_types=1);

namespace Oscmarb\ElasticApm\Utils;

class Utils
{
    public static function removeEmptyElementsFromArray(array $array): ?array
    {
        if (true === empty($array)) {
            return $array;
        }

        $newArray = [];

        foreach ($array as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (false === \is_array($value) || true === empty($value)) {
                $newArray[$key] = $value;
                continue;
            }

            $newValue = self::removeEmptyElementsFromArray($value);

            if (null === $newValue) {
                continue;
            }

            $newArray[$key] = $newValue;
        }

        return true === empty($newArray) ? null : $newArray;
    }
}