<?php

declare(strict_types=1);

namespace App\Infrastructure\Listener;

use App\Domain\Loan\Event\LoanIssued;
use Psr\Log\LoggerInterface;

final readonly class LogLoanIssuedNotification
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(LoanIssued $event): void
    {
        $message = implode(' ', [
            "[{$event->occurredAt()->format('Y-m-d H:i:s')}]",
            "Client: [{$event->clientId}]",
            "Loan: [{$event->loanId}]",
            "loan issued",
        ]);

        $this->logger->info($message, [
            'event' => $event::eventName(),
            'event_id' => $event->eventId(),
            'occurred_at' => $event->occurredAt()->format(DATE_ATOM),
            'loan_id' => $event->loanId,
            'client_id' => $event->clientId,
        ]);
    }
}
