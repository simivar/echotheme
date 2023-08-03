<?php

declare(strict_types=1);

namespace echotheme\Templates\Archive;

use function get_pagenum_link;
use function get_query_var;
use function is_archive;

class PaginationGenerator
{
    public static function generate(): string
    {
        if (!is_archive()) {
            return '';
        }

        global $wp_query;

        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            return '';
        }

        $pages = (int)$pages;
        if ($pages === 1) {
            return '';
        }

        $paged = get_query_var('paged') ? (int)get_query_var('paged') : 1;

        $previousHtml = self::getPreviousHtml($paged);
        $nextHtml = self::getNextHtml($paged, $pages);
        $pagesHtml = self::getPagesHtml($paged, $pages);

        return <<<HTML
<nav aria-label="...">
  <ul class="pagination">
    {$previousHtml}
    {$pagesHtml}
    {$nextHtml}
  </ul>
</nav>
HTML;
    }

    private static function getPagesHtml(int $currentPage, int $maxPages)
    {
        $result = '';

        if ($currentPage - 1 > 1) {
            $result .= self::renderSinglePage($currentPage, 1);
        }

        if ($currentPage - 1 > 2) {
            $result .= self::renderEllipsis();
        }

        if ($currentPage > 1) {
            $result .= self::renderSinglePage($currentPage, $currentPage - 1);
        }
        $result .= self::renderSinglePage($currentPage, $currentPage);
        if ($currentPage !== $maxPages) {
            $result .= self::renderSinglePage($currentPage, $currentPage + 1);
        }

        if ($maxPages - $currentPage > 2) {
            $result .= self::renderEllipsis();
        }

        if ($maxPages - $currentPage > 1) {
            $result .= self::renderSinglePage($currentPage, $maxPages);
        }

        return $result;
    }

    private static function renderSinglePage(int $currentPage, int $page): string
    {
        $link = get_pagenum_link($page);
        $active = $page === $currentPage ? 'active' : '';
        $reset = $page === $currentPage ? 'text-reset' : '';
        return <<<HTML
            <li class="page-item {$active}" aria-current="page">
              <span class="page-link"><a href="{$link}" class="$reset">{$page}</a></span>
            </li>
            HTML;
    }

    private static function renderEllipsis(): string
    {
        return <<<HTML
            <li class="page-item disabled">
              <span class="page-link">&hellip;</span>
            </li>
            HTML;
    }

    private static function getPreviousHtml(int $currentPage)
    {
        if ($currentPage === 1) {
            return <<<HTML
            <li class="page-item disabled">
              <span class="page-link">Poprzednia</span>
            </li>
            HTML;
        }

        $link = get_pagenum_link($currentPage - 1);
        return <<<HTML
        <li class="page-item">
          <span class="page-link"><a href="{$link}">Poprzednia</a></span>
        </li>
        HTML;
    }

    private static function getNextHtml(int $currentPage, int $maxPages)
    {
        if ($currentPage === $maxPages) {
            return <<<HTML
            <li class="page-item disabled">
              <span class="page-link">Następna</span>
            </li>
            HTML;
        }

        $link = get_pagenum_link($currentPage + 1);
        return <<<HTML
        <li class="page-item">
          <span class="page-link"><a href="{$link}">Następna</a></span>
        </li>
        HTML;
    }
}