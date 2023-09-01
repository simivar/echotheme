<?php

declare(strict_types=1);

namespace echotheme\Extensions;

final class PostViewsCounterExtension
{
    private const ECHOTHEME_POST_VIEWS_COLUMN_NAME = 'wpb_post_views_count';

    public static function register(): void
    {
        add_filter('manage_post_posts_columns', [self::class, 'addPostViewsColumn']);
        add_action('manage_post_posts_custom_column', [self::class, 'showPostViews'], 10, 2);
    }

    public static function addPostViewsColumn(array $columns): array
    {
        $columns[self::ECHOTHEME_POST_VIEWS_COLUMN_NAME]  = 'Post Views';

        return $columns;
    }

    public static function showPostViews(string $columnName, int $postId): void
    {
        if ($columnName === self::ECHOTHEME_POST_VIEWS_COLUMN_NAME) {
            echo get_post_meta($postId, self::ECHOTHEME_POST_VIEWS_COLUMN_NAME, true);
        }
    }

    public static function incrementPostView(int $postId): void
    {
        $count = get_post_meta($postId, self::ECHOTHEME_POST_VIEWS_COLUMN_NAME, true);
        if($count === '') {
            delete_post_meta($postId, self::ECHOTHEME_POST_VIEWS_COLUMN_NAME);
            add_post_meta($postId, self::ECHOTHEME_POST_VIEWS_COLUMN_NAME, 1);

            return;
        }

        $count++;
        update_post_meta($postId, self::ECHOTHEME_POST_VIEWS_COLUMN_NAME, $count);
    }

    public static function trackPostViews(): void
    {
        global $post;
        $postId = $post?->ID;
        if (!$postId) {
            return;
        }


        self::incrementPostView($postId);
    }
}
