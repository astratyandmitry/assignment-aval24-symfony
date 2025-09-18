<?php

declare(strict_types=1);

namespace App\Domain\Client\Repository;

use App\Domain\Client\Entity\ClientEntity;
use App\Domain\Client\ValueObject\EmailAddress;
use App\Domain\Client\ValueObject\PersonalIdentificationNumber;
use App\Domain\Client\ValueObject\PhoneNumber;

interface ClientRepository
{
    public function findById(string $id): ?ClientEntity;

    public function create(ClientEntity $client): ClientEntity;

    public function existsByPin(PersonalIdentificationNumber $pin): bool;

    public function existsByEmail(EmailAddress $email): bool;

    public function existsByPhone(PhoneNumber $phone): bool;
}
