<?php

declare(strict_types=1);

namespace echotheme\Extensions;

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
                \echotheme\Navigation\NavigationMapper::HEADER_MENU => __( 'Header Menu' ),
                \echotheme\Navigation\NavigationMapper::FOOTER_MENU => __( 'Footer Menu' ),
                \echotheme\Navigation\NavigationMapper::FOOTER_TOP_MENU => __( 'Footer Small Top Menu' ),
            )
        );
    }
}
