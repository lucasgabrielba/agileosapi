<?php

namespace Domains\Orders\Enums;

enum OrderPriority: string
{
    case NORMAL = 'Normal';
    case HIGTH = 'Alta';
}
