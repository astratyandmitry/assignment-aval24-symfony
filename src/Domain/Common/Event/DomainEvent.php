<?php

declare(strict_types=1);

namespace App\Domain\Common\Event;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

abstract class DomainEvent implements DomainEventContract
{
    private readonly string $eventId;

    private readonly DateTimeImmutable $occurredAt;

    public function __construct(
        private readonly string $aggregateId
    ) {
        $this->eventId = Uuid::v4()->toString();
        $this->occurredAt = new DateTimeImmutable;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function occurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }
}
