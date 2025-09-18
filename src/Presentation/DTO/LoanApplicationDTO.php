<?php

declare(strict_types=1);

namespace App\Presentation\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class LoanApplicationDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $clientId,

        #[Assert\NotBlank]
        #[Assert\Type('float')]
        #[Assert\Positive]
        public float $amountUsd,

        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public int $periodDays,
    ) {
    }
}
