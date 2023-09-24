<?php

declare(strict_types=1);

namespace echotheme\Services;

final class ImageGetter
{
    public static function get(string $size): string
    {
        if (is_singular() && !is_attachment()) {
            $id = get_queried_object_id();

            $thumbnail = get_the_post_thumbnail_url($id, $size);
            if ($thumbnail === false) {
                return '';
            }

            return $thumbnail;
        }

        return '';
    }
}