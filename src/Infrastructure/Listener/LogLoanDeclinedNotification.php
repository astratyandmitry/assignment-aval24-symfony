<?php

declare(strict_types=1);

namespace App\Infrastructure\Listener;

use App\Domain\Loan\Event\LoanDeclined;
use Psr\Log\LoggerInterface;

final readonly class LogLoanDeclinedNotification
{
    public function __construct(
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(LoanDeclined $event): void
    {
        $message = implode(' ', [
            "[{$event->occurredAt()->format('Y-m-d H:i:s')}]",
            "Client: [{$event->clientId}]",
            "loan declined",
        ]);

        $this->logger->info($message, [
            'event' => $event::eventName(),
            'event_id' => $event->eventId(),
            'occurred_at' => $event->occurredAt()->format(DATE_ATOM),
            'client_id' => $event->clientId,
        ]);
    }
}
