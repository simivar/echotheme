<?php

class NewestPostsWithSidebarTemplate
{
    /**
     * @param WP_Post[] $posts
     */
    public static function render(array $posts): void
    {
        if (count($posts) < 1) {
            NoEnoughPostsTemplate::render(1);

            return;
        }

        $postsHtml = '';
        foreach ($posts as $post) {
            $postsHtml .= self::renderSinglePost($post);
        }

        $carousel = self::renderCarousel();

        echo <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-8">
                <div class="mb-4 row">
                    <h2 class="m-0 mb-2">Bądź na bieżąco</h2>
                </div>
                {$postsHtml}
                <div class="row mb-4 justify-content-center">
                    <div class="col-2 d-flex">
                        <button type="button" class="btn btn-danger btn-animation w-100 text-uppercase rounded-pill" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">Więcej</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-4">
                    <div class="row mb-4">
                        <h2 class="m-0 col">Warto przeczytać</h2>
                    </div>
                    <div class="row">
                        {$carousel}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;

    }

    private static function renderSinglePost(WP_Post $post): string
    {
        $link = esc_url(get_permalink($post));
        $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured-wide');

        /** @var WP_Term[] $category */
        $category = get_the_category($post);
        if (empty($category)) {
            $categoryUrl = '';
            $category = '';
        } else {
            $categoryUrl = esc_url(get_category_link($category[0]));
            $category = $category[0]->name;
        }
        $categoryColor = ArbitraryStringToHexColor::generate($category);

        return <<<HTML
<div class="row mb-4">
    <div class="col-5">
        <a href="{$link}" class="d-flex card-img-scale overflow-hidden rounded-3">
            <img class="card-img" src="{$thumbnail}" alt="">
        </a>
    </div>
    <div class="col">
        <div class="flex-column d-flex align-items-start justify-content-center h-100">
            <a href="{$categoryUrl}" class="badge bg-danger text-decoration-none mb-2" style="background-color: #{$categoryColor} !important;">
                {$category}
            </a>

            <h4>
                <a href="{$link}" class="btn-link stretched-link text-reset fw-bold">
                    {$post->post_title}
                </a>
            </h4>
        </div>
    </div>
</div>
HTML;
    }

    /**
     * @return WP_Post[]
     */
    private static function getPopularPostsByViews(): array
    {
        return get_posts([
            'numberposts' => 4,
            'post_type' => 'post',
            'post_status' => 'publish',
            'meta_key' => 'wpb_post_views_count',
            'orderby' => 'wpb_post_views_count meta_value_num',
            'order' => 'DESC',
            'date_query' => [
                'after' => '1 week ago',
                'inclusive' => true,
            ],
        ]);
    }

    private static function renderCarousel(): string
    {
        $posts = self::getPopularPostsByViews();
        $postCount = count($posts);
        if ($postCount < 1) {
            return '';
        }

        $carouselPagination = self::renderCarouselPagination($postCount);

        $carouselItems = '';
        foreach ($posts as $post) {
            if ($carouselItems === '') {
                $carouselItems .= self::renderSingleCarouselItem($post, 'active');
                continue;
            }

            $carouselItems .= self::renderSingleCarouselItem($post);
        }

        return <<<HTML
<div id="carouselExampleCaptions" class="carousel slide col" data-bs-ride="carousel">
<div class="carousel-indicators">
    {$carouselPagination}
</div>
<div class="carousel-inner">
    {$carouselItems}
</div>
</div>
HTML;
    }

    private static function renderSingleCarouselItem(WP_Post $post, string $class = ''): string
    {
        $link = esc_url(get_permalink($post));
        $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured-wide');

        /** @var WP_Term[] $category */
        $category = get_the_category($post);
        if (empty($category)) {
            $categoryUrl = '';
            $category = '';
        } else {
            $categoryUrl = esc_url(get_category_link($category[0]));
            $category = $category[0]->name;
        }
        $categoryColor = ArbitraryStringToHexColor::generate($category);

        return <<<HTML
<div class="carousel-item $class">
    <div class="card text-light card-img-scale w-100 overflow-hidden">
        <img src="{$thumbnail}" class="d-block card-img h-100" alt="...">
        <div class="card-img-overlay d-flex">
            <div class="w-100 mt-auto">
                <a href="{$categoryUrl}" class="badge mb-2" style="background-color: #{$categoryColor} !important;">
                    {$category}
                </a>

                <h2 class="card-title fs-4">
                    <a href="{$link}" class="btn-link stretched-link text-reset">
                        {$post->post_title}
                    </a>
                </h2>
            </div>
        </div>
    </div>
</div>
HTML;

    }

    private static function renderCarouselPagination(int $postCount): string
    {
        $return = '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
        for($i = 1; $i < $postCount; $i++) {
            $num = $i + 1;
            $return .= <<<HTML
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide {$num}"></button>
HTML;
        }

        return $return;
    }
}