<?php

declare(strict_types=1);

namespace echotheme\Dto;

use echotheme\Services\ArbitraryStringToHexColor;

class CategoryWithRecentPostDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $postDate,
    )
    {
    }

    public function escapedUrl(): string
    {
        return esc_url(get_category_link($this->id));
    }

    public function color(): string
    {
        return ArbitraryStringToHexColor::generate($this->name);
    }
}