<?php

get_header();

$posts = get_posts(
    array(
        'numberposts' => 17,
        'post_status' => 'publish',
    )
);

if (count($posts) === 0) {
    NoEnoughPostsTemplate::render();
    get_footer();
    return;
}

FeaturedPostsTemplate::render($posts);