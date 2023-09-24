<?php

namespace echotheme\Services;

use echotheme\Extensions\ImageSizesExtension;

class OpenGraphHeaderGenerator
{
    public static function register(): void
    {
        //zadd_action('wp_head', [__CLASS__, 'header'], 1);
    }

    public static function header(): void
    {
        self::twitter();
        self::opengraph();
    }

    protected static function twitter(): void
    {
        echo sprintf('<meta name="twitter:title" content="%s" />', self::title()) . PHP_EOL;
        if (is_singular() && !is_attachment()) {
            echo '<meta name="twitter:card" content="summary_large_image" />' . PHP_EOL;
            echo sprintf('<meta name="twitter:image" content="%s" />', ImageGetter::get(ImageSizesExtension::TWITTER_CARD)) . PHP_EOL;
        }
    }

    protected static function opengraph(): void
    {
        echo sprintf('<meta name="og:title" content="%s" />', self::title()) . PHP_EOL;
        echo sprintf('<meta name="og:description" content="%s" />', DescriptionGenerator::generate()) . PHP_EOL;
        echo sprintf('<meta name="og:url" content="%s" />', get_permalink()) . PHP_EOL;

        if (is_singular() && !is_attachment()) {
            echo sprintf('<meta name="og:image" content="%s" />', ImageGetter::get(ImageSizesExtension::OPENGRAPH)) . PHP_EOL;
            echo '<meta property="og:type" content="article"/>' . PHP_EOL;
        }
    }

    protected static function title(): string
    {
        $title = wp_title('', false, '');
        if ($title === '') {
            $title = trim(get_bloginfo('name', 'display'));
        }

        return trim($title);
    }
}
