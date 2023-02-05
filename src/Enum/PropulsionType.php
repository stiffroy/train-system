<?php

namespace App\Enum;

enum PropulsionType: string
{
    case DIESEL = 'Diesel';
    case STEAM = 'Steam';
    case ELECTRIC = 'Electric';
}
