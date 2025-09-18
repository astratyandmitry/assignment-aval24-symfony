<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Client\Entity\ClientEntity as DomainClient;
use App\Domain\Client\Repository\ClientRepository;
use App\Domain\Client\ValueObject\EmailAddress;
use App\Domain\Client\ValueObject\PersonalIdentificationNumber;
use App\Domain\Client\ValueObject\PhoneNumber;
use App\Infrastructure\Persistence\Doctrine\Entity\Client;
use App\Infrastructure\Persistence\Doctrine\Mapper\ClientMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineClientRepository extends ServiceEntityRepository implements ClientRepository
{
    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly ClientMapper $mapper,
    ) {
        parent::__construct($this->registry, Client::class);
    }

    public function create(DomainClient $client): DomainClient
    {
        $model = $this->mapper->toNewModel($client);

        $this->getEntityManager()->persist($model);

        return $this->mapper->toDomainEntity($model);
    }

    public function findById(string $id): ?DomainClient
    {
        $model = $this->find($id);

        return $model ? $this->mapper->toDomainEntity($model) : null;
    }

    public function existsByPin(PersonalIdentificationNumber $pin): bool
    {
        return $this->existsByField('pin', (string) $pin);
    }

    public function existsByEmail(EmailAddress $email): bool
    {
        return $this->existsByField('contactEmail', (string) $email);
    }

    public function existsByPhone(PhoneNumber $phone): bool
    {
        return $this->existsByField('contactPhone', (string) $phone);
    }

    private function existsByField(string $field, string $value): bool
    {
        $qb = $this->createQueryBuilder('c')
            ->select('1')
            ->andWhere(sprintf('c.%s = :val', $field))
            ->setParameter('val', $value)
            ->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult() !== null;
    }
}
