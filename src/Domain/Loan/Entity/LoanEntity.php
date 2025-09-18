<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entity;

use App\Domain\Client\Entity\ClientEntity;
use DateTimeImmutable;

final readonly class LoanEntity
{
    public function __construct(
        private string $id,
        private ClientEntity $client,
        private string $name,
        private float $amountUsd,
        private int $periodDays,
        private float $interestRate,
        private DateTimeImmutable $startDate,
        private DateTimeImmutable $endDate,
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function client(): ClientEntity
    {
        return $this->client;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function amountUsd(): float
    {
        return $this->amountUsd;
    }

    public function periodDays(): int
    {
        return $this->periodDays;
    }

    public function interestRate(): float
    {
        return $this->interestRate;
    }

    public function startDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function endDate(): DateTimeImmutable
    {
        return $this->endDate;
    }
}
