<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class AgeRangeRule implements Rule
{
    public function __construct(private int $min, private int $max) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        $age = $application->client()->age();

        return ($age >= $this->min && $age <= $this->max)
            ? RuleEffect::allowed()
            : RuleEffect::denied("Age is not in a range of [{$this->min}..{$this->max}]");
    }
}
