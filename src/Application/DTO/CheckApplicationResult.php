<?php

declare(strict_types=1);

namespace App\Application\DTO;

final readonly class CheckApplicationResult
{
    public function __construct(
        public string $clientId,
        public bool $allowed,
        public ?string $denyReason,
        public float $interestRate,
        public float $amountUsd,
        public int $periodDays,
    ) {}
}
