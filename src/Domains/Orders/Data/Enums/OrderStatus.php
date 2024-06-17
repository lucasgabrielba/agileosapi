<?php

namespace Domains\Orders\Data\Enums;

use Domains\Shared\Traits\ResolvableEnum;

enum OrderStatus: string
{
    use ResolvableEnum;

    case OPEN = 'open';
    case CLOSED = 'closed';

    case REENTRY = 'reentry';
    case PENDING = 'pending';
    case CANCELED = 'canceled';

    public static function default(): self
    {
        return self::OPEN;
    }
}
