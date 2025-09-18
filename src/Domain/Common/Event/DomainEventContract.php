<?php

declare(strict_types=1);

namespace App\Domain\Common\Event;

use DateTimeImmutable;

interface DomainEventContract
{
    public function eventId(): string;

    public function occurredAt(): DateTimeImmutable;

    public function aggregateId(): string;

    public static function eventName(): string;
}
