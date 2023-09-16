<?php

declare(strict_types=1);

namespace echotheme\Dto;

use echotheme\Enum\PaginationItemTypeEnum;

class PaginationItemDto
{
    public function __construct(
        public readonly string|int $label,
        public readonly PaginationItemTypeEnum $type,
        public readonly ?int $page = null,
    )
    {
    }
}
