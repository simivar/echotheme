<?php

declare(strict_types=1);

namespace echotheme\Templates\Generic;

use WP_Post;
use WP_Term;
use function esc_url;
use function get_the_category;
use function get_the_post_thumbnail_url;

class NewestPostsWithSidebarTemplate
{
    /**
     * @param WP_Post[] $posts
     */
    public static function render(array $posts, string $sidebarData, string $title = '', string $description = ''): string
    {
        if (count($posts) < 1) {
            $postsHtml = \echotheme\Templates\Generic\NoEnoughPostsTemplate::render();
        } else {
            $postsHtml = '';
            foreach ($posts as $post) {
                $postsHtml .= self::renderSinglePost($post);
            }
        }

        return ContainerWithSidebarTemplate::render($postsHtml, $sidebarData, $title, $description);
    }

    private static function renderSinglePost(WP_Post $post): string
    {
        $link = esc_url(get_permalink($post));

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

        $escapedTitle = esc_attr(strip_tags($post->post_title));
        $thumbnail = get_the_post_thumbnail_url($post, 'echotheme-featured-archive');

		if ($thumbnail === false) {
			$thumbnail = 'https://placehold.co/261x136/e9ecef/db1b1b?font=Lato&color=dc3545&text=' . wordwrap($escapedTitle, 30, '\n');
		}

        return <<<HTML
<div class="row mb-4">
    <div class="col-12 col-md-6 col-lg-5">
        <a href="{$link}" class="d-flex card-img-scale overflow-hidden rounded-3" aria-label="{$escapedTitle}">
            <img class="card-img" src="{$thumbnail}" alt="{$escapedTitle}" loading="lazy">
        </a>
    </div>
    <div class="col">
        <div class="flex-column d-flex align-items-start justify-content-center h-100">
            <a href="{$categoryUrl}" class="badge bg-danger text-decoration-none my-2" 
            style="background-color: #{$categoryColor} !important;"
            aria-label="Zobacz wpisy z kategorii {$category}">
                {$category}
            </a>

            <h3 class="fs-5">
                <a href="{$link}" class="btn-link text-reset fw-bold">
                    {$post->post_title}
                </a>
            </h3>
        </div>
    </div>
</div>
HTML;
    }
}