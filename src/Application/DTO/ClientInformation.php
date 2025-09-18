<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Domain\Client\Entity\ClientEntity;

final readonly class ClientInformation
{
    public function __construct(
        public string $id,
        public string $pin,
        public string $fullName,
        public string $birthDate,
        public string $region,
        public string $city,
        public string $phone,
        public string $email,
        public int $creditScore,
        public float $monthlyIncomeUsd,
    ) {}

    public static function fromEntity(ClientEntity $client): self
    {
        return new self(
            id: $client->id(),
            pin: (string) $client->pin(),
            fullName: $client->fullName(),
            birthDate: $client->birthDate()->format('Y-m-d'),
            region: $client->region()->value,
            city: $client->city(),
            phone: (string) $client->phone(),
            email: (string) $client->email(),
            creditScore: $client->creditScore(),
            monthlyIncomeUsd: $client->monthlyIncomeUsd(),
        );
    }
}
