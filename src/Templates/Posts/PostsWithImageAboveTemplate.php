<?php

declare(strict_types=1);

namespace echotheme\Templates\Posts;

use echotheme\Dto\PostDto;
use echotheme\Templates\Post\ImageAbovePostTemplate;

class PostsWithImageAboveTemplate
{
    public static function render(string $category, string $categoryLink, PostDto ...$posts): string
    {
        if (count($posts) < 1) {
            return '';
        }

        $postsHtml = '';
        foreach ($posts as $post) {
            $postsHtml .= ImageAbovePostTemplate::render($post);
        }

        return <<<HTML
<section class="pt-4 pb-0" id="category-posts">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <h5 class="m-0 mb-2 fs-3">
                        <a class="text-reset fw-bold" href="{$categoryLink}">{$category}</a>
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
}