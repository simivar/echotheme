<?php

declare(strict_types=1);

namespace echotheme\Templates\Pagination;

use echotheme\Dto\PaginationDto;
use echotheme\Enum\PaginationItemTypeEnum;

class PaginationTemplate
{
    public static function render(PaginationDto $paginationDto): string
    {
        $pagesHtml = self::getPagesHtml($paginationDto);

        return <<<HTML
<section class="pt-4 pb-0">
    <div class="container">
        <div class="row row-cols-2">
            <div class="col-12 col-lg-8">
                <div class="row mb-4">
                    <div class="col d-flex justify-content-end">
                        <nav aria-label="...">
                          <ul class="pagination">
                            {$pagesHtml}
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;
    }

    private static function getPagesHtml(PaginationDto $paginationDto): string
    {
        $html = '';

        foreach ($paginationDto->getItems() as $itemDto) {
            $html .= match ($itemDto->type) {
                PaginationItemTypeEnum::CURRENT => PageItemActive::render($itemDto->label),
                PaginationItemTypeEnum::DISABLED => PageItemDisabled::render($itemDto->label),
                PaginationItemTypeEnum::STANDARD => PageItemStandard::render($itemDto->label, $itemDto->page),
            };
        }

        return $html;
    }
}
