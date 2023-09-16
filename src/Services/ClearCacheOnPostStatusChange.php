<?php

declare(strict_types=1);

namespace echotheme\Services;

class ClearCacheOnPostStatusChange
{
    public static function register(): void
    {
        add_action('transition_post_status', [__CLASS__, 'clear'], 10, 3);
    }

    public static function clear(string $new_status, string $old_status, \WP_Post $post): void
    {
        if ($new_status === $old_status) {
            return;
        }

        Cache::delete(Cache::KEY_FEATURED_POSTS);
    }
}