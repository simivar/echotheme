<?php

declare(strict_types=1);

namespace echotheme\Templates\Pagination;

class PageItemActive
{
    public static function render(int $page): string
    {
        $link = get_pagenum_link($page);

        return <<<HTML
        <li class="page-item active" aria-current="page">
            <span class="page-link"><a href="{$link}" class="text-reset">{$page}</a></span>
        </li>
        HTML;
    }
}
