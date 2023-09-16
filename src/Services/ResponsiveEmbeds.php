<?php

declare(strict_types=1);

namespace echotheme\Services;

use echotheme\Templates\ResponsiveEmbedTemplate;

class ResponsiveEmbeds
{
    public function __construct()
    {
        add_filter( 'oembed_dataparse', [__CLASS__, 'handle'], 99, 4);
    }

    public static function handle($return, $data, $url): string
    {
        $return = str_replace('<iframe', '<iframe loading="lazy"', $return);

        if ('YouTube' !== $data->provider_name) {
            return $return;
        }

        if  (
            isset($data->width, $data->height) &&
            $data->type === 'video' &&
            round($data->height/$data->width, 2) === round(3/4, 2)
        ) {
            return ResponsiveEmbedTemplate::render($return, true);
        }

        return ResponsiveEmbedTemplate::render($return);
    }
}
