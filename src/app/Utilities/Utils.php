<?php

namespace App\Utilities;

class Utils
{
    public static function arrayExclude(array &$dataArray, array $keysToExclude)
    {
        foreach ($dataArray as $key => &$value) {
            if (in_array($key, $keysToExclude)) {
                unset($dataArray[$key]);
                continue;
            }

            if (self::isAssoc($value)) {
                self::arrayExclude($value, $keysToExclude);
                continue;
            }

            if (is_array($value) && !empty($value) && self::isAssoc($value[0])) {
                foreach ($value as &$entry) {
                    self::arrayExclude($entry, $keysToExclude);
                }
            }
        }

        return $dataArray;
    }

    public static function isAssoc($arr)
    {
        if (!is_array($arr) || array() === $arr) {
            return false;
        }

        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    public static function convertToInches($cm)
    {
        $inches = round($cm * 0.393701);

        $result = [
            'ft' => intval($inches / 12),
            'in' => $inches % 12,
        ];

        return $result;
    }
}
