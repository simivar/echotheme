<?php

declare(strict_types=1);

namespace echotheme\Templates\FrontPage;

use WP_Term;
use function esc_url;
use function get_the_category;
use function get_the_post_thumbnail_url;

class FeaturedPostsTemplate
{
    /**
     * @param \WP_Post[] $posts
     */
    public static function render(array $posts): void
    {
        if (count($posts) < 6) {
            echo \echotheme\Templates\Generic\NoEnoughPostsTemplate::render(6);

            return;
        }

        $firstPost = self::renderSinglePost($posts[0], false);
        $secondPost = self::renderSinglePost($posts[1]);
        $thirdPost = self::renderSinglePost($posts[2]);
        $fourthPost = self::renderSinglePost($posts[3]);
        $fifthPost = self::renderSinglePost($posts[4]);
        $sixthPost = self::renderSinglePost($posts[5]);

        echo <<<HTML
<section class="pt-4 pb-0" id="featured-posts">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                {$firstPost}
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col">
                        {$secondPost}
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        {$thirdPost}
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-1">
            <div class="col-lg">
               {$fourthPost}
            </div>
            <div class="col-lg">
                {$fifthPost}
            </div>
            <div class="col-lg">
                {$sixthPost}
            </div>
        </div>
    </div>
</section>
HTML;
    }

    private static function renderSinglePost(\WP_Post $post, bool $isSmaller = true): string
    {
        $link = esc_url(get_permalink($post));

        $escapedTitle = esc_attr(strip_tags(str_replace('"', '\'', $post->post_title)));

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

        $heading = 'h1';
        $class = '';
        if ($isSmaller) {
            $heading = 'h2';
            $class = 'fs-5';
            $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured-small');
        } else {
            $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured');
        }

        return <<<HTML
<div class="card text-light card-img-scale w-100 h-100 overflow-hidden">
    <img src="{$thumbnail}" class="card-img h-100" alt="{$escapedTitle}">
    <div class="card-img-overlay d-flex">
        <div class="w-100 mt-auto">
            <a href="{$categoryUrl}" class="badge text-reset text-decoration-none mb-2" 
                style="background-color: #{$categoryColor} !important;"
                aria-label="Zobacz wpisy z kategorii {$category}">
                {$category}
            </a>

            <{$heading} class="card-title $class">
                <a href="{$link}" class="btn-link stretched-link text-reset">
                    {$post->post_title}
                </a>
            </{$heading}>
        </div>
    </div>
</div>
HTML;
    }
}