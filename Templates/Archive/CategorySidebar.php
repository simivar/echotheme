<?php

declare(strict_types=1);

namespace echotheme\Templates\Archive;

class CategorySidebar
{
    public static function html(): string {
        $categories = \echotheme\Services\GetCategoriesWithRecentPosts::get(5, self::getExcludedCategoryId());

        ob_start();
        include __DIR__ . '/../../views/blocks/sidebar/categories_badges.php';

        return ob_get_clean();
    }

    private static function getExcludedCategoryId(): int
    {
        $queriedObject = get_queried_object();
        if ($queriedObject instanceof \WP_Term) {
            return (int) get_queried_object_id();
        }

        return 0;
    }
}