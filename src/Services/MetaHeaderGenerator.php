<?php

namespace echotheme\Services;

class MetaHeaderGenerator
{
    public static function register(): void
    {
        add_action('wp_head', [__CLASS__, 'header']);
    }

    public static function header(): void
    {
        echo '<meta name="description" content="' . DescriptionGenerator::generate() . '" />' . PHP_EOL;
    }
}
