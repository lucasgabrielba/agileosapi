<?php

namespace Domains\Orders\Enums;

enum OrderStatus: string
{
    case OPEN = 'Aberto';
    case CLOSED = 'Fechado';

    case IN_PROGRESS = 'Em andamento';

    case REENTRY = 'Reentrada';
    case PENDING = 'Pendente';
    case CANCELED = 'Cancelado';
}
