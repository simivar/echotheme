<?php

get_header();

$categoryId = get_queried_object_id();

$category = get_category($categoryId);
$count = $category->category_count;

if (!have_posts()) {
    NoEnoughPostsTemplate::render(1);
    get_footer();

    return;
}

$categories = GetCategoriesWithRecentPosts::get(5, $categoryId);
$categoriesWithSidebar = CategorySidebar::get($categories);

global $wp_query;
$myposts = $wp_query->get_posts();

$postsWithSidebar = NewestPostsWithSidebarTemplate::render($myposts, $categoriesWithSidebar);

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

$postsWithSidebar
HTML;

get_footer();