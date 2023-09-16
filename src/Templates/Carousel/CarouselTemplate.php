<?php

declare(strict_types=1);

namespace echotheme\Templates\Carousel;

use echotheme\Dto\PostDto;

class CarouselTemplate
{
    public static function render(PostDto ...$postDto): string
    {
        $postCount = count($postDto);
        if ($postCount === 0) {
            return '';
        }

        $pagination = CarouselPaginationTemplate::render($postCount);
        $items = CarouselItemsTemplate::render(...$postDto);

        return <<<HTML
<div id="carouselExampleCaptions" class="carousel slide col" data-bs-ride="carousel">
<div class="carousel-indicators">
    {$pagination}
</div>
<div class="carousel-inner">
    {$items}
</div>
</div>
HTML;
    }
}