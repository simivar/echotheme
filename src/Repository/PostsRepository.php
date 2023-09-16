<?php

declare(strict_types=1);

namespace echotheme\Repository;

use echotheme\Dto\PostDto;
use echotheme\Services\Cache;

class PostsRepository
{
    /**
     * @return PostDto[]
     */
    public static function getPublished(int $limit = 16): array {
        $cached = Cache::get(Cache::KEY_FEATURED_POSTS);
        if ($cached !== false) {
            return $cached;
        }

        /** @var \WP_Post[] $posts */
        $posts = get_posts(
            array(
                'numberposts' => $limit,
                'post_status' => 'publish',
            )
        );

        $postDtos = [];
        foreach ($posts as $post) {
            $postDtos[] = new PostDto($post);
        }

        Cache::set(Cache::KEY_FEATURED_POSTS, $postDtos);

        return $postDtos;
    }

    /**
     * @return PostDto[]
     */
    public static function getMostPopularByViews(int $limit = 4): array
    {
        $cached = Cache::get(Cache::KEY_MOST_POPULAR_POSTS);
        if ($cached !== false) {
            return $cached;
        }

        /** @var \WP_Post[] $posts */
        $posts = \get_posts([
            'numberposts' => $limit,
            'post_type' => 'post',
            'post_status' => 'publish',
            'meta_key' => 'wpb_post_views_count',
            'orderby' => 'wpb_post_views_count meta_value_num',
            'order' => 'DESC',
            'date_query' => [
                'after' => '4 weeks ago',
                'inclusive' => true,
            ],
        ]);

        $returnPosts = [];
        foreach ($posts as $post) {
            $returnPosts[] = new PostDto($post);
        }

        Cache::set(Cache::KEY_MOST_POPULAR_POSTS, $returnPosts, Cache::TTL_1_HOUR);

        return $returnPosts;
    }

    /**
     * @return PostDto[]
     */
    public static function getPublishedByCategory(int $categoryId, array $excludedIds = []): array
    {
        $key = sprintf('%s_%s_%s', Cache::KEY_CATEGORY_POSTS, $categoryId, implode('_', $excludedIds));

        $cached = Cache::get($key);
        if ($cached !== false) {
            return $cached;
        }

        $posts = get_posts([
            'numberposts' => 4,
            'post_type' => 'post',
            'post_status' => 'publish',
            'category' => $categoryId,
            'exclude' => $excludedIds,
        ]);

        $returnPosts = [];
        foreach ($posts as $post) {
            $returnPosts[] = new PostDto($post);
        }

        Cache::set($key, $returnPosts, Cache::TTL_1_HOUR);

        return $returnPosts;
    }
}
