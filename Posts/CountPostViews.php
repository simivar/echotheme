<?php

const ECHOTHEME_POST_VIEWS_COLUMN_NAME = 'wpb_post_views_count';

function echotheme_count_post_views(array $columns): array {
    $columns[ECHOTHEME_POST_VIEWS_COLUMN_NAME]  = 'Post Views';

    return $columns;
}
add_filter('manage_post_posts_columns', 'echotheme_count_post_views');

function echotheme_post_show_views(string $column_name, int $post_id): void
{
    if ($column_name === ECHOTHEME_POST_VIEWS_COLUMN_NAME) {
        echo get_post_meta($post_id, ECHOTHEME_POST_VIEWS_COLUMN_NAME, true);
    }
}
add_action('manage_post_posts_custom_column', 'echotheme_post_show_views', 10, 2);

function increment_post_view(int $postId) {
    $count = get_post_meta($postId, ECHOTHEME_POST_VIEWS_COLUMN_NAME, true);
    if($count === '') {
        delete_post_meta($postId, ECHOTHEME_POST_VIEWS_COLUMN_NAME);
        add_post_meta($postId, ECHOTHEME_POST_VIEWS_COLUMN_NAME, 1);

        return;
    }

    $count++;
    update_post_meta($postId, ECHOTHEME_POST_VIEWS_COLUMN_NAME, $count);
}

function track_post_views() {
    if (!is_single()) {
        return;
    }

    global $post;
    $postId = $post->ID;

    increment_post_view($postId);
}
add_action( 'wp_head', 'track_post_views');
