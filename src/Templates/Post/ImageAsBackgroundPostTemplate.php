<?php

declare(strict_types=1);

namespace echotheme\Templates\Post;

use echotheme\Dto\PostDto;

class ImageAsBackgroundPostTemplate
{
    public static function render(PostDto $postDto, bool $isSmaller = true, bool $disableLazyLoad = false): string
    {
        $title = self::renderTitle($postDto, $isSmaller);
        $thumbnail = $isSmaller ? $postDto->thumbnailFeaturedSmall() : $postDto->thumbnailFeatured();
        $lazyLoad = $disableLazyLoad ? '' : 'loading="lazy"';

        return <<<HTML
    <div class="card text-light card-img-scale w-100 h-100 overflow-hidden">
        <img src="{$thumbnail}" class="d-block card-img h-100 img-fluid object-fit-fill" alt="{$postDto->escapedTitle()}" {$lazyLoad}>
        <div class="card-img-overlay d-flex">
            <div class="w-100 mt-auto">
                <a href="{$postDto->mainCategoryLink()}" class="badge text-reset text-decoration-none mb-2"
                    style="background-color: #{$postDto->mainCategoryColor()} !important;"
                    aria-label="Zobacz wpisy z kategorii">
                    {$postDto->mainCategoryName()}
                </a>

                {$title}
            </div>
        </div>
    </div>
HTML;
    }

    private static function renderTitle(PostDto $postDto, bool $isSmaller = true): string
    {
        if ($isSmaller) {
            return <<<HTML
            <h2 class="card-title fs-5">
                <a href="{$postDto->link()}" class="btn-link stretched-link text-reset" aria-label="{$postDto->escapedTitle()}">
                    {$postDto->title()}
                </a>
            </h2>
        HTML;
        }

        return <<<HTML
            <h1 class="card-title">
                <a href="{$postDto->link()}" class="btn-link stretched-link text-reset" aria-label="{$postDto->escapedTitle()}">
                    {$postDto->title()}
                </a>
            </h1>
        HTML;
    }
}