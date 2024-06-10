<?php

namespace Domains\Organizations\Data\Enums;

use Domains\Shared\Traits\ResolvableEnum;

enum OrganizationStatus: string
{
    use ResolvableEnum;
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case FREE_TRIAL = 'free_trial';

    public static function default(): self
    {
        return self::ACTIVE;
    }
}
