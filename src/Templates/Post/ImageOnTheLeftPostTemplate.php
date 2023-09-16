<?php

declare(strict_types=1);

namespace echotheme\Templates\Post;

use echotheme\Dto\PostDto;

class ImageOnTheLeftPostTemplate
{
    public static function render(PostDto $postDto): string
    {
        return <<<HTML
<div class="row mb-4">
    <div class="col-12 col-md-6 col-lg-5">
        <a href="{$postDto->link()}" class="d-flex card-img-scale overflow-hidden rounded-3" aria-label="{$postDto->escapedTitle()}">
            <img class="card-img" src="{$postDto->thumbnailFeaturedArchive()}" alt="{$postDto->escapedTitle()}" loading="lazy">
        </a>
    </div>
    <div class="col">
        <div class="flex-column d-flex align-items-start justify-content-center h-100">
            <a href="{$postDto->mainCategoryLink()}" class="badge bg-danger text-decoration-none my-2" 
            style="background-color: #{$postDto->mainCategoryColor()} !important;"
            aria-label="Zobacz wpisy z kategorii {$postDto->mainCategoryName()}">
                {$postDto->mainCategoryName()}
            </a>

            <h3 class="fs-5">
                <a href="{$postDto->link()}" class="btn-link text-reset fw-bold">
                    {$postDto->title()}
                </a>
            </h3>
        </div>
    </div>
</div>
HTML;
    }
}