<?php

declare(strict_types=1);

namespace App\Domain\Loan\ValueObject;

use InvalidArgumentException;

final readonly class InterestRate
{
    public function __construct(private float $rate)
    {
        if ($rate < 0) {
            throw new InvalidArgumentException('Interest rate cannot be negative.');
        }
    }

    public function value(): float
    {
        return round($this->rate, 2);
    }

    public function applyDelta(float $delta): self
    {
        return new self($this->rate + $delta);
    }
}
