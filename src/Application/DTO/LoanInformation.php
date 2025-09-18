<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Loan\Entity\LoanEntity;

final readonly class LoanInformation
{
    public function __construct(
        public string $id,
        public string $name,
        public float $amountUsd,
        public int $periodDays,
        public float $interestRate,
        public string $startDate,
        public string $endDate,
    ) {}

    public static function fromEntity(LoanEntity $entity): self
    {
        return new self(
            id: $entity->id(),
            name: $entity->name(),
            amountUsd: $entity->amountUsd(),
            periodDays: $entity->periodDays(),
            interestRate: $entity->interestRate(),
            startDate: $entity->startDate()->format('Y-m-d'),
            endDate: $entity->endDate()->format('Y-m-d'),
        );
    }
}
