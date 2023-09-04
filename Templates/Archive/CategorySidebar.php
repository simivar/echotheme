<?php

declare(strict_types=1);

namespace echotheme\Templates\Archive;

use echotheme\Dto\CategoryWithRecentPostDto;

class CategorySidebar
{
    /**
     * @param CategoryWithRecentPostDto[] $categories
     */
    public static function get(array $categories): string {
        ob_start();
        include __DIR__ . '/../../views/blocks/sidebar/category_badge.php';

        return ob_get_clean();
    }
}