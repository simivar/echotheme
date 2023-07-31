<?php

get_header();

$posts = get_posts(
    array(
        'numberposts' => 16,
        'post_status' => 'publish',
    )
);

if (count($posts) === 0) {
    echo \echotheme\Templates\Generic\NoEnoughPostsTemplate::render();
    get_footer();
    return;
}

$featuredPosts = array_slice($posts, 0, 6);
\echotheme\Templates\FrontPage\FeaturedPostsTemplate::render($featuredPosts);

$featuredPosts = array_slice($posts, 6);
\echotheme\Templates\FrontPage\NewestPostsWithCarouselSidebar::render($featuredPosts);

echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="row mb-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12 d-flex">
                        <a href="/?post_type=post" type="button" class="btn btn-danger btn-animation w-100 text-uppercase rounded-pill" aria-label="Close">
                            <span aria-hidden="true">Więcej</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;


$categoryPostsSectionsIds = get_theme_mod('frontpage_categories');
if (is_array($categoryPostsSectionsIds) && count($categoryPostsSectionsIds) > 0) {
    foreach ($categoryPostsSectionsIds as $categoryPostsSectionId) {
        echo \echotheme\Templates\FrontPage\CategoryPostsSectionTemplate::render($categoryPostsSectionId);
    }
}

get_footer();