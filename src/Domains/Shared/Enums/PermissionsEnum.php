<?php

namespace App\Domains\Organizations\Data\Enums;

enum PermissionsEnum: string
{
    case VIEW_ORDERS = 'view:orders';
    case CREATE_ORDERS = 'create:orders';
    case EDIT_ORDERS = 'edit:orders';
    case DELETE_ORDERS = 'delete:orders';

    case VIEW_ORGANIZATIONS = 'view:organizations';
    case CREATE_ORGANIZATIONS = 'create:organizations';
    case EDIT_ORGANIZATIONS = 'edit:organizations';
    case DELETE_ORGANIZATIONS = 'delete:organizations';

    case VIEW_USERS = 'view:users';
    case CREATE_USERS = 'create:users';
    case EDIT_USERS = 'edit:users';
    case DELETE_USERS = 'delete:users';
}
