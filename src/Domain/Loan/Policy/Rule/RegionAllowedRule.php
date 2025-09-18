<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class RegionAllowedRule implements Rule
{
    /**
     * @param  array<\App\Domain\Client\Enum\Region>  $regions
     */
    public function __construct(private array $regions) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        return in_array($application->client()->region(), $this->regions)
            ? RuleEffect::allowed()
            : RuleEffect::denied('Region is not allowed list');
    }
}
