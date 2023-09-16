<?php

declare(strict_types=1);

namespace echotheme\Services\Ads;

class Monetag
{
    public static function register(): void
    {
        add_action('wp_head', [__CLASS__, 'header']);
    }

    public static function header(): void
    {
        echo '<meta name="monetag" content="575cfcfabb3a353fdc8ed63d630983ea">';
    }
}