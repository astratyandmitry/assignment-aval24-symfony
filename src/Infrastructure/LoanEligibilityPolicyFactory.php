<?php

namespace App\Infrastructure;

use App\Domain\Client\Enum\Region;
use App\Domain\Loan\Policy\LoanEligibilityPolicy;
use App\Domain\Loan\Policy\Rule\AgeRangeRule;
use App\Domain\Loan\Policy\Rule\MinimumCreditScoreRule;
use App\Domain\Loan\Policy\Rule\MinimumMonthlyIncomeRule;
use App\Domain\Loan\Policy\Rule\PeriodDaysRangeRule;
use App\Domain\Loan\Policy\Rule\RegionAllowedRule;
use App\Domain\Loan\Policy\Rule\RegionIncreaseInterestRateRule;
use App\Domain\Loan\Policy\Rule\RegionRandomDeclineRule;
use App\Domain\Loan\ValueObject\InterestRate;

final readonly class LoanEligibilityPolicyFactory
{
    public static function create(): LoanEligibilityPolicy
    {
        return new LoanEligibilityPolicy(
            baseInterestRate: new InterestRate(0.10),
            rules: [
                new AgeRangeRule(min: 18, max: 60),
                new MinimumMonthlyIncomeRule(min: 1000),
                new MinimumCreditScoreRule(min: 500),
                new PeriodDaysRangeRule(min: 30, max: 90),
                new RegionAllowedRule(regions: Region::cases()),
                new RegionRandomDeclineRule(region: Region::PR),
                new RegionIncreaseInterestRateRule(region: Region::OS, increasePercentage: 0.05),
            ]
        );
    }
}
