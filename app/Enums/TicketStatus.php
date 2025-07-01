<?php

namespace App\Enums;

enum TicketStatus: string
{
    case PENDING = 'pending';
    case CANCELED = 'canceled';
    case PURCHASED = 'purchased';
    case RETURNED = 'returned';
}
