<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Client\Enum\Region;
use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class RegionIncreaseInterestRateRule implements Rule
{
    public function __construct(private Region $region, private float $increasePercentage) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        if ($application->client()->region() === $this->region) {
            return RuleEffect::allowedWithRateDelta($this->increasePercentage);
        }

        return RuleEffect::allowed();
    }
}
