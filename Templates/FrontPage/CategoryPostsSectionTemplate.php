<?php

declare(strict_types=1);

namespace echotheme\Templates\FrontPage;

use WP_Term;
use function esc_url;
use function get_category;
use function get_posts;
use function get_the_post_thumbnail_url;

class CategoryPostsSectionTemplate
{
    public static function render(int $categoryId, array $exclude = []): string
    {
        $posts = get_posts([
            'numberposts' => 4,
            'post_type' => 'post',
            'post_status' => 'publish',
            'category' => $categoryId,
            'exclude' => $exclude,
        ]);
        if (count($posts) < 1) {
            return '';
        }

        /** @var WP_Term $categoryData */
        $categoryData = get_category($categoryId);
        $categoryLink = esc_url(get_category_link($categoryId));

        $postsHtml = '';
        foreach ($posts as $post) {
            $postsHtml .= self::renderSinglePost($post, $categoryData->name, $categoryLink);
        }

        return <<<HTML
<section class="pt-4 pb-0" id="category-posts">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <h5 class="m-0 mb-2 fs-3">
                        <a class="text-reset fw-bold" href="{$categoryLink}">{$categoryData->name}</a>
                    </h5>
                </div>
                <div class="row mb-4">
                    {$postsHtml}
                </div>
            </div>
        </div>
    </div>
</section>
HTML;

    }

    private static function renderSinglePost(\WP_Post $post, string $category, string $categoryUrl): string
    {
        $link = esc_url(get_permalink($post));
        $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured-wide');

        $escapedTitle = esc_attr(strip_tags(str_replace('"', '\'', $post->post_title)));
        if ($thumbnail === false) {
            $thumbnail = 'https://placehold.co/261x158/e9ecef/db1b1b?font=Lato&color=dc3545&text=' . wordwrap($escapedTitle, 30, '\n');
        }

        $categoryColor = \echotheme\Services\ArbitraryStringToHexColor::generate($category);


        return <<<HTML

<div class="col-xl-3 col-md-6 col-12">
    <div class="row">
        <div class="col">
            <a href="{$link}" class="d-flex card-img-scale overflow-hidden rounded-3" aria-label="{$escapedTitle}">
                <img class="card-img" src="{$thumbnail}" alt="{$escapedTitle}" loading="lazy">
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="flex-column d-flex align-items-start justify-content-center h-100">
                <a href="{$categoryUrl}" class="badge bg-danger text-decoration-none my-2" 
                    style="background-color: #{$categoryColor} !important;"
                    aria-label="Zobacz wpisy z kategorii {$category}">
                    {$category}
                </a>
    
                <h5>
                    <a href="{$link}" class="btn-link text-reset fw-bold">
                        {$post->post_title}
                    </a>
                </h5>
            </div>
        </div>
    </div>
</div>
HTML;
    }
}