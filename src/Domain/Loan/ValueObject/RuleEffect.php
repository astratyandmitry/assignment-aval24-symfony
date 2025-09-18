<?php

declare(strict_types=1);

namespace App\Domain\Loan\ValueObject;

final readonly class RuleEffect
{
    private function __construct(
        private bool $allowed,
        private ?string $denyReason,
        private ?float $rateDelta,
    ) {}

    public static function allowed(): self
    {
        return new self(true, null, null);
    }

    public static function allowedWithRateDelta(float $rateDelta): self
    {
        return new self(true, null, $rateDelta);
    }

    public static function denied(string $reason): self
    {
        return new self(false, $reason, null);
    }

    public function isDenied(): bool
    {
        return ! $this->allowed;
    }

    public function denyReason(): ?string
    {
        return $this->denyReason;
    }

    public function rateDelta(): ?float
    {
        return $this->rateDelta;
    }
}
