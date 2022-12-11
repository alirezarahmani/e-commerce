<?php

declare(strict_types=1);

namespace App\ValueObjects;

enum OrderStatus: int
{
    case CANCELED = -1;
    case DONE = 1;
    case PENDING = 0;
}
