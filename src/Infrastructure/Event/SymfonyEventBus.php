<?php

declare(strict_types=1);

namespace App\Infrastructure\Event;

use App\Application\Shared\EventBus;
use App\Domain\Common\Event\DomainEventContract;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final readonly class SymfonyEventBus implements EventBus
{
    public function __construct(private EventDispatcherInterface $dispatcher) {}

    public function publish(DomainEventContract ...$events): void
    {
        foreach ($events as $event) {
            $this->dispatcher->dispatch($event);
        }
    }
}
