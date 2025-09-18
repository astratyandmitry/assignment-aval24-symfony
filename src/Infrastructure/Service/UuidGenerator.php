<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Common\Service\IdGenerator;
use Symfony\Component\Uid\Uuid;

final readonly class UuidGenerator implements IdGenerator
{
    public function generate(): string
    {
        return Uuid::v4()->toString();
    }
}
