<?php

declare(strict_types=1);

namespace echotheme\Services\Ads;

class Monetag
{
    public static function header(): void
    {
        echo '<meta name="monetag" content="575cfcfabb3a353fdc8ed63d630983ea">';
    }
}