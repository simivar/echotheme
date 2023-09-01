<?php

declare(strict_types=1);

namespace echotheme\Services;

class ResponsiveEmbeds
{
    public function __construct()
    {
        add_filter( 'oembed_dataparse', [ResponsiveEmbeds::class, 'handle'], 99, 4);
    }

    public static function handle($return, $data, $url): string
    {
        $mod = '';

        if  (   ( $data->type == 'video' ) &&
            ( isset($data->width) ) && ( isset($data->height) ) &&
            ( round($data->height/$data->width, 2) == round( 3/4, 2) )
        )
        {
            $mod = 'ratio-4x3';
        } else {
            $mod = 'ratio-16x9';
        }

        return '<div class="ratio ' . $mod . '">' . $return . '</div>';
    }
}