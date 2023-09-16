<?php

declare(strict_types=1);

namespace echotheme\Extensions;

use echotheme\Services\Navigation\NavigationMapper;

final class MenusExtension
{
    public static function register(): void
    {
        add_action( 'init', [self::class, 'registerMenus'] );
    }

    public static function registerMenus(): void
    {
        register_nav_menus(
            array(
                NavigationMapper::HEADER_MENU => __( 'Header Menu' ),
                NavigationMapper::FOOTER_MENU => __( 'Footer Menu' ),
                NavigationMapper::FOOTER_TOP_MENU => __( 'Footer Small Top Menu' ),
            )
        );
    }
}
