<?php

declare(strict_types=1);

namespace App\Domain\Loan\Policy\Rule;

use App\Domain\Loan\Entity\ApplicationEntity;
use App\Domain\Loan\ValueObject\RuleEffect;

final readonly class MinimumCreditScoreRule implements Rule
{
    public function __construct(private int $min) {}

    public function evaluate(ApplicationEntity $application): RuleEffect
    {
        return $application->client()->creditScore() > $this->min
            ? RuleEffect::allowed()
            : RuleEffect::denied("Credit Score is less than {$this->min}");
    }
}
