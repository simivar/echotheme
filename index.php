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

$categoryPostsSectionsIds = get_theme_mod('frontpage_categories');
if (count($categoryPostsSectionsIds) > 0) {
    foreach ($categoryPostsSectionsIds as $categoryPostsSectionId) {
        CategoryPostsSection::render($categoryPostsSectionId);
    }
}

get_footer();