<?php

declare(strict_types=1);

namespace echotheme\Templates\Archive;

class CategorySidebar
{
    public static function html(int $excludedCategoryId): string {
        $categories = \echotheme\Services\GetCategoriesWithRecentPosts::get(5, $excludedCategoryId);

        ob_start();
        include __DIR__ . '/../../views/blocks/sidebar/category_badge.php';

        return ob_get_clean();
    }
}