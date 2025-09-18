<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Client\Enum\Region;
use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class RegionRandomDeclineRule implements Rule
{
    public function __construct(private Region $region) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        if ($application->client()->region() !== $this->region) {
            return RuleEffect::allowed();
        }

        return random_int(0, 1) === 0
            ? RuleEffect::denied("Random region decline for {$this->region->value}")
            : RuleEffect::allowed();
    }
}
