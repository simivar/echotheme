<?php

namespace echotheme\Services;

class DescriptionGenerator
{
    public static function generate(): string
    {
        $queriedObject = get_queried_object();
        if ($queriedObject instanceof \WP_Post) {
            $des_post = strip_tags($queriedObject->post_content);
            $des_post = trim($des_post);
            $des_post = strip_shortcodes($des_post);
            $des_post = str_replace(array("\n", "\r", "\t"), ' ', $des_post);
            $des_post = mb_substr($des_post, 0, 155, 'utf8');

            if (strlen($queriedObject->post_content) > strlen($des_post)) {
                $des_post .= '...';
            }

            return $des_post;
        }

        if ($queriedObject instanceof \WP_Term) {
            return strip_tags(category_description());
        }

        return get_bloginfo("description");
    }
}
