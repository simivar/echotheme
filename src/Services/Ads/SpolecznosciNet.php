<?php

declare(strict_types=1);

namespace echotheme\Services\Ads;

use echotheme\Templates\Ads\SpolecznosciNetAdTemplate;

final class SpolecznosciNet
{
    public static function register(): void
    {
        add_filter('the_content', [__CLASS__, 'content']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'footer']);
    }

    public static function content(string $theContent): string
    {
        if ( !is_singular()) {
            return $theContent;
        }

        $newContent = SpolecznosciNetAdTemplate::render(9579, 9585);

        $splitByParagraphs = explode('</p>', $theContent);
        foreach ($splitByParagraphs as $i => $iValue) {
            $newContent .= $iValue . '</p>';

            if ($i === 0) {
                $newContent .= SpolecznosciNetAdTemplate::render(9580, 9587);
            }

            if ($i === 2) {
                $newContent .= SpolecznosciNetAdTemplate::render(9583, 9588);
            }
        }

        return $newContent;
    }

    public static function footer(): void
    {
        wp_enqueue_script(
            handle: 'spolecznoscinet-ads-js',
            src: 'https://a.spolecznosci.net/core/2963a7ab5f0df0381007f04d65008312/main.js',
            args: [
                'in_footer' => true,
                'strategy'  => 'async',
            ],
        );

        wp_add_inline_script('spolecznoscinet-ads-js', "var _qasp = _qasp || []; _qasp.push(['setPAID']);", 'before');
    }
}
