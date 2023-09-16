<?php

get_header();

if (!have_posts()) {
    echo \echotheme\Templates\Generic\ContainerWithSidebarTemplate::render(
        \echotheme\Templates\Generic\NoEnoughPostsTemplate::render(),
        \echotheme\Views\CategoriesBadgesView::view(),
    );
    get_footer();

    return;
}

global $wp_query;

$count = $wp_query->found_posts;
$posts = $wp_query->get_posts();

$postsDtos = [];
foreach ($posts as $post) {
    $postsDtos[] = new \echotheme\Dto\PostDto($post);
}

$postsBadge = <<<HTML
<span class="badge text-bg-success fs-6 mt-2 ms-2 position-absolute">{$count} posts</span>
HTML;


$title = get_the_archive_title() . $postsBadge;
$content = \echotheme\Templates\Posts\PostsWithImageOnTheLeftTemplate::render(...$postsDtos);
$sidebar = \echotheme\Views\CategoriesBadgesView::view();

echo \echotheme\Templates\Generic\ContainerWithSidebarTemplate::render($content, $sidebar, $title);
echo \echotheme\Templates\Pagination\PaginationTemplate::render(
    \echotheme\Services\PaginationGenerator::generate(),
);


get_footer();