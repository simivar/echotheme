<?php

get_header();

$posts = get_posts(
    array(
        'numberposts' => 16,
        'post_status' => 'publish',
    )
);

if (count($posts) === 0) {
    NoEnoughPostsTemplate::render();
    get_footer();
    return;
}

$featuredPosts = array_slice($posts, 0, 6);
FeaturedPostsTemplate::render($featuredPosts);

$featuredPosts = array_slice($posts, 6);
NewestPostsWithSidebarTemplate::render($featuredPosts);

get_footer();