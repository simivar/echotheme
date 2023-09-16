<?php

declare(strict_types=1);

namespace echotheme\Templates\Post;

use echotheme\Dto\PostDto;

class ImageAbovePostTemplate
{
    public static function render(PostDto $postDto): string
    {
        return <<<HTML
<div class="col-xl-3 col-md-6 col-12">
    <div class="row">
        <div class="col">
            <a href="{$postDto->link()}" class="d-flex card-img-scale overflow-hidden rounded-3" aria-label="{$postDto->escapedTitle()}">
                <img class="card-img" src="{$postDto->thumbnailFeaturedWide()}" alt="{$postDto->escapedTitle()}" loading="lazy">
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="flex-column d-flex align-items-start justify-content-center h-100">
                <a href="{$postDto->mainCategoryLink()}" class="badge bg-danger text-decoration-none my-2" 
                    style="background-color: #{$postDto->mainCategoryColor()} !important;"
                    aria-label="Zobacz wpisy z kategorii">
                    {$postDto->mainCategoryName()}
                </a>
    
                <h5>
                    <a href="{$postDto->link()}" class="btn-link text-reset fw-bold">
                        {$postDto->title()}
                    </a>
                </h5>
            </div>
        </div>
    </div>
</div>
HTML;
    }
}