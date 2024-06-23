<?php

namespace Domains\Orders\Data\Enums;

enum OrderStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';

    case REENTRY = 'reentry';
    case PENDING = 'pending';
    case CANCELED = 'canceled';
}
