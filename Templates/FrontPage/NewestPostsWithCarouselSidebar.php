<?php

declare(strict_types=1);

namespace echotheme\Templates\FrontPage;

use WP_Term;
use function esc_url;
use function get_the_category;
use function get_the_post_thumbnail_url;

class NewestPostsWithCarouselSidebar
{
    /**
     * @param \WP_Post[] $posts
     */
    public static function render(array $posts): void
    {
        if (count($posts) < 1) {
            $posts = [];
        }

        $carousel = self::renderCarousel();

        echo \echotheme\Templates\Generic\NewestPostsWithSidebarTemplate::render($posts, $carousel);
    }

    /**
     * @return \WP_Post[]
     */
    private static function getPopularPostsByViews(): array
    {
        return \get_posts([
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

    private static function renderSingleCarouselItem(\WP_Post $post, string $class = ''): string
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
        $categoryColor = \echotheme\Services\ArbitraryStringToHexColor::generate($category);

        return <<<HTML
<div class="carousel-item $class">
    <div class="card text-light card-img-scale w-100 overflow-hidden">
        <img src="{$thumbnail}" class="d-block card-img h-100 img-fluid object-fit-fill" alt="..." loading="lazy">
        <div class="card-img-overlay d-flex">
            <div class="w-100 mt-auto">
                <a href="{$categoryUrl}" class="badge mb-2" style="background-color: #{$categoryColor} !important;">
                    {$category}
                </a>

                <h6 class="card-title">
                    <a href="{$link}" class="btn-link stretched-link text-reset">
                        {$post->post_title}
                    </a>
                </h6>
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
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{$i}" aria-label="Slide {$num}"></button>
HTML;
        }

        return $return;
    }
}