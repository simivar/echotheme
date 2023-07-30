<?php

get_header();


if (!have_posts()) {
    echo \echotheme\Templates\Generic\NoEnoughPostsTemplate::render(1);
    get_footer();

    return;
}

$queriedObject = get_queried_object();

global $wp_query;

$count = $wp_query->found_posts;
$myposts = $wp_query->get_posts();
$description = get_the_archive_description();

$title = get_the_archive_title();
if ($queriedObject instanceof \WP_Term) {
    $categoryId = get_queried_object_id();

} else {
    $categoryId = 0;
}

$categories = \echotheme\Services\GetCategoriesWithRecentPosts::get(5, $categoryId);
$categoriesWithSidebar = \echotheme\Templates\Archive\CategorySidebar::get($categories);

$postsWithSidebar = \echotheme\Templates\Generic\NewestPostsWithSidebarTemplate::render($myposts, $categoriesWithSidebar);

echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-4">
                <h1>{$title}</h1>
                <span class="badge text-bg-success fs-6 my-2">{$count} posts</span>
                <p>
                    {$description}
                </p>
            </div>
        </div>
    </div>
</section>

$postsWithSidebar
HTML;


$pagination = \echotheme\Templates\Archive\PaginationGenerator::generate();
echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="row mb-4">
                    <div class="col d-flex justify-content-end">
                        {$pagination}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;


get_footer();