<?php

declare(strict_types=1);

namespace echotheme\Extensions;

final class ImageSizesExtension
{
    public static function register(): void
    {
        add_theme_support('post-thumbnails');

        self::addImageSizes();
        self::addCustomLogo();
    }

    private static function addImageSizes(): void
    {
        add_image_size('echotheme-featured', 1284, 840, true);
        add_image_size('echotheme-featured-small', 624, 401, true);
        add_image_size('echotheme-featured-archive', 513, 315, true);
        add_image_size('echotheme-featured-wide', 459, 278, true);
    }

    private static function addCustomLogo(): void
    {
        $logo_width  = 415;
        $logo_height = 45;

        add_theme_support(
            'custom-logo',
            array(
                'height'               => $logo_height,
                'width'                => $logo_width,
                'flex-width'           => true,
                'flex-height'          => true,
                'unlink-homepage-logo' => true,
            )
        );
    }
}
