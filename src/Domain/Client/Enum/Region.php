<?php

declare(strict_types=1);

namespace App\Domain\Client\Enum;

enum Region: string
{
    case PR = 'Prague';
    case BR = 'Brno';
    case OS = 'Ostrava';
}
