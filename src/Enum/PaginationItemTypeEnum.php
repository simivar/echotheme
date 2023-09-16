<?php

declare(strict_types=1);

namespace echotheme\Enum;

enum PaginationItemTypeEnum: string
{
    case STANDARD = 'STANDARD';
    case CURRENT = 'CURRENT';
    case DISABLED = 'DISABLED';
}
