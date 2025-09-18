<?php

declare(strict_types=1);

namespace App\Application\Shared;

use App\Domain\Common\Event\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}
