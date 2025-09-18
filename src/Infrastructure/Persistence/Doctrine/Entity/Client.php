<?php

namespace App\Infrastructure\Persistence\Doctrine\Entity;

use App\Domain\Client\Repository\ClientRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ORM\UniqueConstraint(name: 'uniq_clients_pin', columns: ['pin'])]
#[ORM\UniqueConstraint(name: 'uniq_clients_contact_email', columns: ['contact_email'])]
#[ORM\UniqueConstraint(name: 'uniq_clients_contact_phone', columns: ['contact_phone'])]
final class Client
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    public string $id;

    #[ORM\Column(type: 'string', length: 16)]
    public string $pin;

    #[ORM\Column(type: 'string')]
    public string $fullName;

    #[ORM\Column(name: 'location_city', type: 'string', length: 120)]
    public string $locationCity;

    #[ORM\Column(name: 'location_region', type: 'string', length: 32)]
    public string $locationRegion;

    #[ORM\Column(name: 'contact_phone', type: 'string', length: 14)]
    public string $contactPhone;

    #[ORM\Column(name: 'contact_email', type: 'string', length: 80)]
    public string $contactEmail;

    #[ORM\Column(name: 'credit_score', type: 'integer')]
    public int $creditScore;

    #[ORM\Column(name: 'monthly_income_usd', type: 'decimal')]
    public float $monthlyIncomeUsd;

    #[ORM\Column(name: 'birth_date', type: 'date_immutable')]
    public DateTimeImmutable $birthDate;

    #[ORM\OneToMany(targetEntity: Loan::class, mappedBy: 'client', cascade: ['persist'], orphanRemoval: true)]
    private Collection $loans;

    public function __construct()
    {
        $this->loans = new ArrayCollection();
    }

    /**
     * @return Collection<int, Loan>
     */
    public function loans(): Collection
    {
        return $this->loans;
    }

    public function addLoan(Loan $loan): void
    {
        if (! $this->loans->contains($loan)) {
            $this->loans->add($loan);
            $loan->setClient($this);
        }
    }

    public function removeLoan(Loan $loan): void
    {
        if ($this->loans->removeElement($loan)) {
            if ($loan->getClient() === $this) {
                $loan->setClient(null);
            }
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPin(): string
    {
        return $this->pin;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getLocationCity(): string
    {
        return $this->locationCity;
    }

    public function getLocationRegion(): string
    {
        return $this->locationRegion;
    }

    public function getContactPhone(): string
    {
        return $this->contactPhone;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function getCreditScore(): int
    {
        return $this->creditScore;
    }

    public function getMonthlyIncomeUsd(): float
    {
        return $this->monthlyIncomeUsd;
    }

    public function getBirthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setPin(string $pin): void
    {
        $this->pin = $pin;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function setLocationCity(string $locationCity): void
    {
        $this->locationCity = $locationCity;
    }

    public function setLocationRegion(string $locationRegion): void
    {
        $this->locationRegion = $locationRegion;
    }

    public function setContactPhone(string $contactPhone): void
    {
        $this->contactPhone = $contactPhone;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function setCreditScore(int $creditScore): void
    {
        $this->creditScore = $creditScore;
    }

    public function setMonthlyIncomeUsd(float $monthlyIncomeUsd): void
    {
        $this->monthlyIncomeUsd = $monthlyIncomeUsd;
    }

    public function setBirthDate(DateTimeImmutable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
}
