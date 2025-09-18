<?php

declare(strict_types=1);

namespace App\Domain\Client\ValueObject;

use InvalidArgumentException;
use Stringable;

final class EmailAddress implements Stringable
{
    public function __construct(private string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid Email address format');
        }

        $this->value = strtolower($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
