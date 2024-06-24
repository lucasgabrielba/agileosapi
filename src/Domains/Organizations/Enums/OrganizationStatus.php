<?php

namespace Domains\Organizations\Enums;

enum OrganizationStatus: string
{
    case ACTIVE = 'Ativo';
    case INACTIVE = 'Inativo';
    case FREE_TRIAL = 'Teste gratuito';
}
