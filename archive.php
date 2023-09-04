<?php

get_header();

$categoriesWithSidebar = \echotheme\Templates\Archive\CategorySidebar::html();

if (!have_posts()) {
    echo \echotheme\Templates\Generic\ContainerWithSidebarTemplate::render(
        \echotheme\Templates\Generic\NoEnoughPostsTemplate::render(),
        $categoriesWithSidebar,
    );
    get_footer();

    return;
}

global $wp_query;

$count = $wp_query->found_posts;
$myposts = $wp_query->get_posts();
$description = get_the_archive_description();

$postsBadge = <<<HTML
<span class="badge text-bg-success fs-6 mt-2 ms-2 position-absolute">{$count} posts</span>
HTML;


$title = get_the_archive_title() . $postsBadge;

echo \echotheme\Templates\Generic\NewestPostsWithSidebarTemplate::render($myposts, $categoriesWithSidebar, $title, $description);

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