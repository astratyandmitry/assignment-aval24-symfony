<?php

declare(strict_types=1);

namespace App\Domain\Loan\Entity;

use App\Domain\Client\Entity\ClientEntity;

final readonly class ApplicationEntity
{
    public function __construct(
        private ClientEntity $client,
        private float $amountUsd,
        private int $periodDays,
    ) {}

    public function client(): ClientEntity
    {
        return $this->client;
    }

    public function amountUsd(): float
    {
        return $this->amountUsd;
    }

    public function periodDays(): int
    {
        return $this->periodDays;
    }
}
