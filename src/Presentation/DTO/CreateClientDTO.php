<?php

declare(strict_types=1);

namespace App\Presentation\DTO;

use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class CreateClientDTO
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(max: 16)]
        public string $pin,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $fullName,

        #[Assert\NotBlank]
        #[Assert\Date]
        public string $birthDate,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $region,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $city,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        public string $phone,

        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        public int $creditScore,

        #[Assert\NotBlank]
        #[Assert\Type('integer')]
        #[Assert\Positive]
        public int $monthlyIncomeUsd,
    ) {
    }
}
