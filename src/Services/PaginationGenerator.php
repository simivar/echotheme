<?php

declare(strict_types=1);

namespace echotheme\Services;

use echotheme\Dto\PaginationDto;
use echotheme\Dto\PaginationItemDto;
use echotheme\Enum\PaginationItemTypeEnum;

class PaginationGenerator
{
    public static function generate(): PaginationDto
    {
        $dto = new PaginationDto();

        if (!is_archive() && !is_paged()) {
            return $dto;
        }

        global $wp_query;

        $pagesCount = (int)$wp_query->max_num_pages;
        if ($pagesCount <= 1) {
            return $dto;
        }

        $currentPage = get_query_var('paged') ? (int)get_query_var('paged') : 1;

        $dto->addItem(self::generatePrevious($currentPage));

        self::generateMiddle($currentPage, $pagesCount, $dto);

        $dto->addItem(self::generateNext($currentPage, $pagesCount));

        return $dto;
    }

    private static function generatePrevious(int $currentPage): PaginationItemDto
    {
        if ($currentPage === 1) {
            return new PaginationItemDto('Poprzednia', PaginationItemTypeEnum::DISABLED);
        }

        return new PaginationItemDto('Poprzednia', PaginationItemTypeEnum::STANDARD, $currentPage - 1);
    }

    private static function generateMiddle(int $currentPage, int $maxPages, PaginationDto $paginationDto): void
    {
        if ($currentPage - 1 > 1) {
            $paginationDto->addItem(new PaginationItemDto(
                1, PaginationItemTypeEnum::STANDARD, 1,
            ));
        }

        if ($currentPage - 1 > 2) {
            $paginationDto->addItem(new PaginationItemDto(
                '&hellip;', PaginationItemTypeEnum::DISABLED,
            ));
        }

        if ($currentPage > 1) {
            $paginationDto->addItem(new PaginationItemDto(
                $currentPage - 1, PaginationItemTypeEnum::STANDARD, $currentPage - 1,
            ));
        }

        $paginationDto->addItem(new PaginationItemDto(
            $currentPage, PaginationItemTypeEnum::CURRENT, $currentPage,
        ));

        if ($currentPage !== $maxPages) {
            $paginationDto->addItem(new PaginationItemDto(
                $currentPage + 1, PaginationItemTypeEnum::STANDARD, $currentPage + 1,
            ));
        }

        if ($maxPages - $currentPage > 2) {
            $paginationDto->addItem(new PaginationItemDto(
                '&hellip;', PaginationItemTypeEnum::DISABLED,
            ));
        }

        if ($maxPages - $currentPage > 1) {
            $paginationDto->addItem(new PaginationItemDto(
                $maxPages, PaginationItemTypeEnum::STANDARD, $maxPages,
            ));
        }
    }

    private static function generateNext(int $currentPage, int $maxPage): PaginationItemDto
    {
        if ($currentPage === $maxPage) {
            return new PaginationItemDto('Następna', PaginationItemTypeEnum::DISABLED);
        }

        return new PaginationItemDto('Poprzednia', PaginationItemTypeEnum::STANDARD, $currentPage + 1);
    }
}