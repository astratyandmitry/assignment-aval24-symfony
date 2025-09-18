<?php

declare(strict_types=1);

namespace App\Domain\Loan\Event;

use App\Domain\Common\Event\DomainEvent;

final class LoanDeclined extends DomainEvent
{
    public function __construct(
        public readonly string $clientId,
        public readonly string $denyReason,
    ) {
        parent::__construct($clientId);
    }

    public static function eventName(): string
    {
        return 'loan.declined';
    }
}
