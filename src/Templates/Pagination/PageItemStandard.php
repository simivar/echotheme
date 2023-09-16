<?php

declare(strict_types=1);

namespace echotheme\Templates\Pagination;

class PageItemStandard
{
    public static function render(string|int $title, int $page): string
    {
        $link = get_pagenum_link($page);

        return <<<HTML
        <li class="page-item">
            <span class="page-link"><a href="{$link}">{$title}</a></span>
        </li>
        HTML;
    }
}
