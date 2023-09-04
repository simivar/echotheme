<?php

declare(strict_types=1);

namespace echotheme\Dto;

class CategoryWithRecentPostDto
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $postDate,
    )
    {
    }
}