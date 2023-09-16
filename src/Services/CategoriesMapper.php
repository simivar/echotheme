<?php

declare(strict_types=1);

namespace echotheme\Services;

use function get_categories;

class CategoriesMapper
{
    /**
     * @return array<int, string>
     */
    public static function mapAsIdToNameArray(): array
    {
        $categories = get_categories([
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC'
        ]);

        $result = [];
        foreach ($categories as $category) {
            $result[$category->term_id] = $category->name;
        }

        return $result;
    }
}