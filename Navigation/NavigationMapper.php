<?php

declare(strict_types=1);

namespace echotheme\Navigation;

class NavigationMapper
{
    public const HEADER_MENU = 'header-menu';
    public const FOOTER_MENU = 'footer-menu';
    public const FOOTER_TOP_MENU = 'footer-top-menu';

    private static int $currentCategoryId;

    /**
     * @return array<NavigationItem>
     */
    public static function getMappedMenuItems(string $menuName): array {
        $cacheKey = 'getMappedMenuItems' . $menuName;

        $cached = wp_cache_get( $cacheKey, 'echotheme' );
        if ($cached !== false) {
            return $cached;
        }

        $existingMenuLocations = get_nav_menu_locations();
        if (!array_key_exists($menuName, $existingMenuLocations)) {
            wp_cache_set( $cacheKey, [], 'echotheme' );

            return [];
        }

        $menuItems = wp_get_nav_menu_items($existingMenuLocations[$menuName]);
        if ($menuItems === false) {
            wp_cache_set( $cacheKey, [], 'echotheme' );

            return [];
        }

        $return = [];
        foreach ($menuItems as $item) {
            if ($item->menu_item_parent !== '0') {
                $return[$item->menu_item_parent]->addChildren(self::mapWpPostToArray($item));
                continue;
            }

            $return[$item->ID] = self::mapWpPostToArray($item);
        }

        wp_cache_set( $cacheKey, $return, 'echotheme' );

        return $return;
    }

    public static function getCurrentCategoryId(): int
    {
        if (isset(self::$currentCategoryId)) {
            return self::$currentCategoryId;
        }

        $queriedObject = get_queried_object();
        if ($queriedObject === null) {
            return 0;
        }

        if ($queriedObject instanceof \WP_User) {
            return 0;
        }

        if ($queriedObject instanceof \WP_Post) {
            $queriedObject = get_the_category($queriedObject->ID);
            if (empty($queriedObject)) {
                return 0;
            }

            $queriedObject = $queriedObject[0];
        }

        self::$currentCategoryId = $queriedObject->term_id;

        return self::$currentCategoryId;
    }

    private static function mapWpPostToArray(\WP_Post $item): NavigationItem {
        return new NavigationItem(
            $item->title,
            $item->url,
            $item->object,
            (int) $item->object_id,
        );
    }
}