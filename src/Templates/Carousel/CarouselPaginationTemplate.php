<?php

declare(strict_types=1);

namespace echotheme\Templates\Carousel;

class CarouselPaginationTemplate
{
    public static function render(int $postCount): string
    {
        $return = '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
        for($i = 1; $i < $postCount; $i++) {
            $num = $i + 1;
            $return .= <<<HTML
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{$i}" aria-label="Slide {$num}"></button>
HTML;
        }

        return $return;
    }
}