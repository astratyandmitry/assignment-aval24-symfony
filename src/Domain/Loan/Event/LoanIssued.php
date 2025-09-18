<?php

declare(strict_types=1);

namespace App\Domain\Loan\Event;

use App\Domain\Common\Event\DomainEvent;

final class LoanIssued extends DomainEvent
{
    public function __construct(
        public readonly string $loanId,
        public readonly string $clientId,
    ) {
        parent::__construct($loanId);
    }

    public static function eventName(): string
    {
        return 'loan.issued';
    }
}
