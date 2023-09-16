<?php

use echotheme\Templates\Carousel\CarouselTemplate;
use echotheme\Templates\Generic\ContainerWithSidebarTemplate;
use echotheme\Templates\Posts\PostsWithImageOnTheLeftTemplate;

get_header();

if (is_paged()) {
    include 'archive.php';

    return;
}

echo \echotheme\Templates\Ads\SpolecznosciNetAdTemplate::render(9579, 9585);

/** @var \WP_Post[] $posts */
$postDtos = \echotheme\Repository\PostsRepository::getPublished();

if (count($postDtos) === 0) {
    echo \echotheme\Templates\Generic\NoEnoughPostsTemplate::render();
    get_footer();
    return;
}

$featuredPosts = array_slice($postDtos, 0, 6);
echo \echotheme\Templates\FrontPage\FeaturedPostsTemplate::render(...$featuredPosts);

$featuredPosts = array_slice($postDtos, 6);
echo ContainerWithSidebarTemplate::render(
    PostsWithImageOnTheLeftTemplate::render(...$featuredPosts),
    CarouselTemplate::render(...\echotheme\Repository\PostsRepository::getMostPopularByViews()),
);

echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="row mb-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-7 col-12 d-flex">
                        <a href="/page/2" type="button" class="btn btn-danger btn-animation w-100 text-uppercase rounded-pill" aria-label="Close">
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

echo \echotheme\Templates\Ads\SpolecznosciNetAdTemplate::render(9582, 9586);

$categoryPostsSectionsIds = get_theme_mod('frontpage_categories');

if (is_array($categoryPostsSectionsIds) && count($categoryPostsSectionsIds) > 0) {
    foreach ($categoryPostsSectionsIds as $categoryPostsSectionId) {
        echo \echotheme\Views\CategoryPostsWithImageAboveView::view($categoryPostsSectionId);
    }
}

get_footer();