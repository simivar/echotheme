<?php

namespace echotheme\Services;

class MetaHeaderGenerator
{
    public static function generate(): void
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

            echo '<meta name="description" content="' . $des_post . '" />' . "\n";

            return;
        }

        if ($queriedObject instanceof \WP_Term) {
            $des_cat = strip_tags(category_description());
            echo '<meta name="description" content="' . $des_cat . '" />' . "\n";

            return;
        }

        echo '<meta name="description" content="' . get_bloginfo("description") . '" />' . "\n";
    }
}
