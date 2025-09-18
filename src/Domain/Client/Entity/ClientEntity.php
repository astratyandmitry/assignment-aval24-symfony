<?php

declare(strict_types=1);

namespace App\Domain\Client\Entity;

use App\Domain\Client\Enum\Region;
use App\Domain\Client\ValueObject\EmailAddress;
use App\Domain\Client\ValueObject\PersonalIdentificationNumber;
use App\Domain\Client\ValueObject\PhoneNumber;
use DateTimeImmutable;

final readonly class ClientEntity
{
    public function __construct(
        private string $id,
        private PersonalIdentificationNumber $pin,
        private string $fullName,
        private DateTimeImmutable $birthDate,
        private Region $region,
        private string $city,
        private PhoneNumber $phone,
        private EmailAddress $email,
        private int $creditScore,
        private float $monthlyIncomeUsd,
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function fullName(): string
    {
        return $this->fullName;
    }

    public function birthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate->diff(new DateTimeImmutable('now'))->y;
    }

    public function region(): Region
    {
        return $this->region;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function creditScore(): int
    {
        return $this->creditScore;
    }

    public function monthlyIncomeUsd(): float
    {
        return $this->monthlyIncomeUsd;
    }

    public function pin(): PersonalIdentificationNumber
    {
        return $this->pin;
    }

    public function email(): EmailAddress
    {
        return $this->email;
    }

    public function phone(): PhoneNumber
    {
        return $this->phone;
    }
}
