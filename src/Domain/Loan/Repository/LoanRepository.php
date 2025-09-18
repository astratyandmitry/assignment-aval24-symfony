<?php

declare(strict_types=1);

namespace App\Domain\Loan\Repository;

use App\Domain\Loan\Entity\LoanEntity;

interface LoanRepository
{
    public function create(LoanEntity $entity): LoanEntity;
}
