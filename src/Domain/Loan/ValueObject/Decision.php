<?php

declare(strict_types=1);

namespace App\Domain\Loan\ValueObject;

final readonly class Decision
{
    private function __construct(
        private bool $allow,
        private InterestRate $interestRate,
        private ?string $denyReason,
    ) {}

    public static function allowed(InterestRate $interestRate): self
    {
        return new self(true, $interestRate, null);
    }

    public static function denied(string $reason): self
    {
        return new self(false, new InterestRate(0.0), $reason);
    }

    public function allow(): bool
    {
        return $this->allow;
    }

    public function interestRate(): InterestRate
    {
        return $this->interestRate;
    }

    public function denyReason(): ?string
    {
        return $this->denyReason;
    }
}
