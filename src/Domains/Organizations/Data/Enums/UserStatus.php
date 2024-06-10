<?php

namespace Domains\Organizations\Data\Enums;

use Domains\Shared\Traits\ResolvableEnum;

enum UserStatus: string
{
    use ResolvableEnum;
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function default(): self
    {
        return self::ACTIVE;
    }
}
