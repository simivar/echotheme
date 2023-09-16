<?php

declare(strict_types=1);

namespace echotheme\Services;

class Cache
{
    public const GROUP = 'echotheme';

    public const KEY_FEATURED_POSTS = 'featured_posts';
    public const KEY_MOST_POPULAR_POSTS = 'most_popular_posts';
    public const KEY_CATEGORY_POSTS = 'category_posts_';

    public const TTL_1_HOUR = 3600;

    public static function get(string $key): mixed
    {
        return wp_cache_get($key, self::GROUP);
    }

    public static function set(int|string $key, mixed $value, int $ttlSeconds = 0): bool
    {
        return wp_cache_set($key, $value, self::GROUP, $ttlSeconds);
    }

    public static function delete(int|string $key): bool
    {
        return wp_cache_delete($key, self::GROUP);
    }
}
