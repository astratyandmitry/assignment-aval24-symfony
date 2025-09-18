<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Loan\Entity\LoanEntity;
use App\Domain\Loan\Repository\LoanRepository;
use App\Infrastructure\Persistence\Doctrine\Entity\Loan;
use App\Infrastructure\Persistence\Doctrine\Mapper\LoanMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineLoanRepository extends ServiceEntityRepository implements LoanRepository
{
    public function __construct(
        private readonly ManagerRegistry $registry,
        private readonly LoanMapper $mapper,
    ) {
        parent::__construct($this->registry, Loan::class);
    }

    public function create(LoanEntity $entity): LoanEntity
    {
        $model = $this->mapper->toNewModel($entity);

        $this->getEntityManager()->persist($model);

        return $entity;
    }
}
