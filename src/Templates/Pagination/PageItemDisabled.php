<?php

declare(strict_types=1);

namespace echotheme\Templates\Pagination;

class PageItemDisabled
{
    public static function render(string $title): string
    {
        return <<<HTML
        <li class="page-item disabled">
            <span class="page-link">{$title}</span>
        </li>
        HTML;
    }
}