<?php

declare(strict_types=1);

namespace echotheme\Templates\Archive;

use echotheme\Dto\CategoryWithRecentPostDto;
use function esc_url;

class CategorySidebar
{
    /**
     * @param CategoryWithRecentPostDto[] $data
     */
    public static function get(array $data): string {
        $html = '';
        foreach ($data as $category) {
            $html .= self::renderSingle($category);
        }

        return $html;
    }

    private static function renderSingle(CategoryWithRecentPostDto $category): string
    {
        ob_start();
        include __DIR__ . '/../../views/blocks/sidebar/category_badge.php';
        $contents = ob_get_clean();

        return $contents;
    }
}