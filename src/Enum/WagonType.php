<?php

namespace App\Enum;

enum WagonType: string
{
    case PASSENGER = 'Passenger';
    case SLEEPING = 'Sleeping';
    case DINING = 'Dining';
    case FREIGHT = 'Freight';
    case OTHERS = 'Others';
}
