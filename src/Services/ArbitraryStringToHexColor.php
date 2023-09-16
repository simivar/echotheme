<?php

declare(strict_types=1);

namespace echotheme\Services;

class ArbitraryStringToHexColor
{
    /** @var array<string, string> */
    protected static array $cache = [];

    public static function generate(string $string): string
    {
        if (array_key_exists($string, self::$cache)) {
            return self::$cache[$string];
        }

        $hash = 0;
        $strLength = strlen($string);

        // Convert each character in the string to ASCII and sum them up
        for($i = 0; $i < $strLength; $i++){
            $hash += ord($string[$i]);
        }

        // Factor to make the color darker (value between 0 and 1)
        $darkFactor = 0.6;

        // Generate color components, and apply the dark factor
        $r = (int)(($hash * 123) % 256 * $darkFactor);
        $g = (int)(($hash * 456) % 256 * $darkFactor);
        $b = (int)(($hash * 789) % 256 * $darkFactor);

        // Convert them to hex and ensure they are 2 characters long
        $r = str_pad(dechex($r), 2, "0", STR_PAD_LEFT);
        $g = str_pad(dechex($g), 2, "0", STR_PAD_LEFT);
        $b = str_pad(dechex($b), 2, "0", STR_PAD_LEFT);

        // Combine the color components
        $colorCode = $r . $g . $b;

        self::$cache[$string] = $colorCode;

        return $colorCode;
    }
}