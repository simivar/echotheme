<?php

get_header();

$categoryId = get_queried_object_id();

$category = get_category($categoryId);
$count = $category->category_count;

if (!have_posts()) {
}


global $wp_query;
$myposts = $wp_query->get_posts();

$posts = NewestPostsWithSidebarTemplate::render($myposts, '');

echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-4">
                <h1>{$category->name}</h1>
                <span class="badge text-bg-success fs-6 my-2">{$count} posts</span>
                <p>
                    {$category->description}
                </p>
            </div>
        </div>
    </div>
</section>

$posts
HTML;

get_footer();