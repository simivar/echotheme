<?php

declare(strict_types=1);

namespace echotheme\Templates\Carousel;

use echotheme\Dto\PostDto;

class CarouselItemsTemplate
{
    public static function render(PostDto ...$postDto): string
    {
        $carouselItems = '';
        foreach ($postDto as $post) {
            if ($carouselItems === '') {
                $carouselItems .= CarouselItemTemplate::render($post, 'active');
                continue;
            }

            $carouselItems .= CarouselItemTemplate::render($post);
        }

        return $carouselItems;
    }
}