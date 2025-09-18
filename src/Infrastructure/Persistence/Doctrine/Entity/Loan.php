<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use App\Infrastructure\Persistence\Doctrine\Repository\DoctrineLoanRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctrineLoanRepository::class)]
final class Loan
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    private string $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(name: 'amount_usd', type: 'decimal', precision: 15, scale: 2)]
    private float $amountUsd;

    #[ORM\Column(name: 'period_days', type: 'integer')]
    private int $periodDays;

    #[ORM\Column(name: 'interest_rate', type: 'decimal', precision: 6, scale: 4)]
    private float $interestRate;

    #[ORM\Column(name: 'start_date', type: 'date_immutable')]
    private DateTimeImmutable $startDate;

    #[ORM\Column(name: 'end_date', type: 'date_immutable')]
    private DateTimeImmutable $endDate;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'loans')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private Client $client;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmountUsd(): float
    {
        return $this->amountUsd;
    }

    public function setAmountUsd(float $amountUsd): void
    {
        $this->amountUsd = $amountUsd;
    }

    public function getPeriodDays(): int
    {
        return $this->periodDays;
    }

    public function setPeriodDays(int $periodDays): void
    {
        $this->periodDays = $periodDays;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    public function getStartDate(): DateTimeImmutable
    {
        return $this->startDate;
    }

    public function setStartDate(DateTimeImmutable $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): DateTimeImmutable
    {
        return $this->endDate;
    }

    public function setEndDate(DateTimeImmutable $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }
}
