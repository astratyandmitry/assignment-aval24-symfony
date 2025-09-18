<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Client\Entity\ClientEntity;
use App\Domain\Client\Enum\Region;
use App\Domain\Client\ValueObject\EmailAddress;
use App\Domain\Client\ValueObject\PersonalIdentificationNumber;
use App\Domain\Client\ValueObject\PhoneNumber;
use App\Infrastructure\Persistence\Doctrine\Entity\Client;

final readonly class ClientMapper
{
    public function toExistingModel(ClientEntity $entity, Client $model): Client
    {
        $model->setId($entity->id());
        $model->setPin((string) $entity->pin());
        $model->setFullName($entity->fullName());
        $model->setBirthDate($entity->birthDate());
        $model->setLocationRegion($entity->region()->value);
        $model->setLocationCity($entity->city());
        $model->setCreditScore($entity->creditScore());
        $model->setMonthlyIncomeUsd($entity->monthlyIncomeUsd());
        $model->setContactEmail((string) $entity->email());
        $model->setContactPhone((string) $entity->phone());

        return $model;
    }

    public function toNewModel(ClientEntity $entity): Client
    {
        return self::toExistingModel($entity, new Client);
    }

    public function toDomainEntity(Client $model): ClientEntity
    {
        return new ClientEntity(
            id: $model->getId(),
            pin: new PersonalIdentificationNumber($model->getPin()),
            fullName: $model->getFullName(),
            birthDate: $model->getBirthDate(),
            region: Region::from($model->getLocationRegion()),
            city: $model->getLocationCity(),
            phone: new PhoneNumber($model->getContactPhone()),
            email: new EmailAddress($model->getContactEmail()),
            creditScore: $model->getCreditScore(),
            monthlyIncomeUsd: $model->getMonthlyIncomeUsd(),
        );
    }
}
