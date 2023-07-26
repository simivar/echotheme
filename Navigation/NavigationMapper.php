<?php

declare(strict_types=1);

require_once get_template_directory() . '/Navigation/NavigationItem.php';

class NavigationMapper
{
    public const HEADER_MENU = 'header-menu';
    public const FOOTER_MENU = 'footer-menu';

    private static int $currentCategoryId = 0;

    /**
     * @return array<NavigationItem>
     */
    public static function getMappedMenuItems(string $menuName): array {
        self::setCurrentCategoryId();

        $existingMenuLocations = get_nav_menu_locations();
        if (!array_key_exists($menuName, $existingMenuLocations)) {
            return [];
        }

        $menuItems = wp_get_nav_menu_items($existingMenuLocations[$menuName]);

        $return = [];
        foreach ($menuItems as $item) {
            if ($item->menu_item_parent !== '0') {
                $return[$item->menu_item_parent]->addChildren(self::mapWpPostToArray($item));
                continue;
            }

            $return[$item->ID] = self::mapWpPostToArray($item);
        }

        return $return;
    }

    private static function setCurrentCategoryId(): void
    {
        $queriedObject = get_queried_object();
        if ($queriedObject === null) {
            return;
        }

        self::$currentCategoryId = $queriedObject->term_id;
    }

    private static function mapWpPostToArray(WP_Post $item): NavigationItem {
        return new NavigationItem(
            $item->title,
            $item->url,
            $item->object,
            (int) $item->object_id === self::$currentCategoryId
        );
    }
}