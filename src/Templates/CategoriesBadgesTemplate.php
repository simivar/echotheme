<?php

declare(strict_types=1);

namespace echotheme\Templates;

use echotheme\Dto\CategoryWithRecentPostDto;

class CategoriesBadgesTemplate
{
    public static function render(CategoryWithRecentPostDto ...$categories): string
    {
        $html = '';

        foreach ($categories as $category) {
            $html .= <<<HTML
            <div class="rounded p-2 mb-2" style="background-color: #{$category->color()}25;">
                <a href="{$category->escapedUrl()}" class="text-decoration-none" style="color: #{$category->color()};">
                    <h6 class="m-0">{$category->name}</h6>
                </a>
            </div>
            HTML . PHP_EOL;
        }

        return $html;
    }
}