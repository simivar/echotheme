<?php

declare(strict_types=1);

namespace echotheme\Dto;

class PaginationDto
{
    /**
     * @param PaginationItemDto[] $items
     */
    public function __construct(private array $items = [])
    {
    }

    public function addItem(PaginationItemDto $itemDto): void
    {
        $this->items[] = $itemDto;
    }

    /**
     * @return PaginationItemDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
