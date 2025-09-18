<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Mapper;

use App\Domain\Loan\Entity\LoanEntity;
use App\Infrastructure\Persistence\Doctrine\Entity\Client;
use App\Infrastructure\Persistence\Doctrine\Entity\Loan;
use Doctrine\ORM\EntityManagerInterface;

final readonly class LoanMapper
{
    public function __construct(
        private EntityManagerInterface $em,
        private ClientMapper $clientMapper,
    ) {
    }

    public function toExistingModel(LoanEntity $entity, Loan $model): Loan
    {
        $model->setId($entity->id());
        $model->setName($entity->name());
        $model->setAmountUsd($entity->amountUsd());
        $model->setPeriodDays($entity->periodDays());
        $model->setInterestRate($entity->interestRate());
        $model->setStartDate($entity->startDate());
        $model->setEndDate($entity->endDate());

        $clientRef = $this->em->getReference(Client::class, $entity->client()->id());
        $model->setClient($clientRef);

        return $model;
    }

    public function toNewModel(LoanEntity $entity): Loan
    {
        return self::toExistingModel($entity, new Loan);
    }

    public function toDomainEntity(Loan $model): LoanEntity
    {
        $client = $this->clientMapper->toDomainEntity($model->getClient());

        return new LoanEntity(
            id: $model->getId(),
            client: $client,
            name: $model->getName(),
            amountUsd: $model->getAmountUsd(),
            periodDays: $model->getPeriodDays(),
            interestRate: $model->getInterestRate(),
            startDate: $model->getStartDate(),
            endDate: $model->getEndDate(),
        );
    }
}
