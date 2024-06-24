<?php

namespace Domains\Organizations\Enums;

enum UserStatus: string
{
    case ACTIVE = 'Ativo';
    case INACTIVE = 'Inativo';
}
