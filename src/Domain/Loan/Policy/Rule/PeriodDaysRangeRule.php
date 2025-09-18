<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class PeriodDaysRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        $periodDays = $application->periodDays();

        return ($periodDays >= $this->min && $periodDays <= $this->max)
            ? RuleEffect::allowed()
            : RuleEffect::denied("Period in days is not in a range of [{$this->min}..{$this->max}]");
    }
}
