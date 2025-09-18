<?php

declare(strict_types=1);

namespace App\Domain\Client\ValueObject;

use InvalidArgumentException;
use Stringable;

final readonly class PersonalIdentificationNumber implements Stringable
{
    public function __construct(private string $value)
    {
        if (in_array(preg_match('/^[A-Za-z0-9\-]{6,}$/', $value), [0, false], true)) {
            throw new InvalidArgumentException('Invalid Personal Identification Number format');
        }
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
