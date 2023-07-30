<?php

declare(strict_types=1);

namespace echotheme\Services;

class ArbitraryStringToHexColor
{
    public static function generate(string $string): string
    {
        return self::intToRGB(self::hashCode($string));
    }

    private static function hashCode(string $str) {
        $hash = 0;
        $iMax = strlen($str);
        for ($i = 0; $i < $iMax; $i++) {
            $hash = ord($str[$i]) + (($hash << 5) - $hash);
        }
        return $hash;
    }

    private static function intToRGB($i) {
        $c = ($i & 0x00FFFFFF);
        $c = strtoupper(dechex($c));
        return str_pad($c, 6, '0', STR_PAD_LEFT);
    }
}