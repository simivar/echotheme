<?php

declare(strict_types=1);

namespace echotheme\Templates\Carousel;

use echotheme\Dto\PostDto;

class CarouselItemTemplate
{
    public static function render(PostDto $postDto, string $class = ''): string
    {
        return <<<HTML
<div class="carousel-item {$class}">
    <div class="card text-light card-img-scale w-100 h-100 overflow-hidden">
        <img src="{$postDto->thumbnailFeaturedArchive()}" class="d-block card-img h-100 img-fluid object-fit-fill" alt="{$postDto->escapedTitle()}" loading="lazy">
        <div class="card-img-overlay d-flex">
            <div class="w-100 mt-auto">
                <a href="{$postDto->mainCategoryLink()}" class="badge text-reset text-decoration-none mb-2" 
                    style="background-color: #{$postDto->mainCategoryColor()} !important;"
                    aria-label="Zobacz wpisy z kategorii">
                    {$postDto->mainCategoryName()}
                </a>

                <h4 class="card-title">
                    <a href="{$postDto->link()}" class="btn-link stretched-link text-reset" aria-label="{$postDto->escapedTitle()}">
                        {$postDto->title()}
                    </a>
                </h4>
            </div>
        </div>
    </div>
</div>
HTML;
    }
}