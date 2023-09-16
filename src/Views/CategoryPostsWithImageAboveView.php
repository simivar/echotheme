<?php

declare(strict_types=1);

namespace echotheme\Views;

use echotheme\Repository\PostsRepository;
use echotheme\Templates\Posts\PostsWithImageAboveTemplate;

class CategoryPostsWithImageAboveView
{
    /**
     * @param int[] $excludedIds
     */
    public static function view(int $categoryId, array $excludedIds = []): string {
        /** @var WP_Term $categoryData */
        $categoryData = get_category($categoryId);
        $categoryLink = esc_url(get_category_link($categoryId));

        return PostsWithImageAboveTemplate::render(
            $categoryData->name,
            $categoryLink,
            ...PostsRepository::getPublishedByCategory($categoryId, $excludedIds),
        );
    }
}