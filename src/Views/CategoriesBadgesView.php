<?php

declare(strict_types=1);

namespace echotheme\Views;

use echotheme\Repository\CategoryRepository;
use echotheme\Templates\CategoriesBadgesTemplate;

class CategoriesBadgesView
{
    public static function view(): string {
        $categories = CategoryRepository::getWithRecentPosts(5, self::getExcludedCategoryId());

        return CategoriesBadgesTemplate::render(...$categories);
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