<?php

declare(strict_types=1);

namespace App\Domain\Client\ValueObject;

use InvalidArgumentException;
use Stringable;

final class PhoneNumber implements Stringable
{
    public function __construct(private string $value)
    {
        $digits = preg_replace('/\D+/', '', $value);

        if (strlen((string) $digits) < 11) {
            throw new InvalidArgumentException('Invalid Phone number format');
        }

        $this->value = '+'.ltrim((string) $digits, '+');
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
