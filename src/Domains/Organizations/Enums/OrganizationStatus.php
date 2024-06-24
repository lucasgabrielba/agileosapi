<?php

namespace Domains\Organizations\Enums;

enum OrganizationStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case FREE_TRIAL = 'free_trial';
}
