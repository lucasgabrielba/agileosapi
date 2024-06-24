<?php

namespace Domains\Orders\Enums;

enum OrderStatus: string
{
    case OPEN = 'Aberto';
    case CLOSED = 'Fechado';

    case REENTRY = 'Reentrada';
    case PENDING = 'Pendente';
    case CANCELED = 'Cancelado';
}
