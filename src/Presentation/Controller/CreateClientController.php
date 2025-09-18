<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\DTO\CreateClientCommand;
use App\Application\UseCase\CreateClientHandler;
use App\Presentation\DTO\CreateClientDTO;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CreateClientController extends AbstractController
{
    public function __construct(
        private readonly CreateClientHandler $handler,
    ) {
    }

    #[Route('/clients', name: 'app_client_create', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateClientDTO $dto,
    ): Response {
        $cmd = new CreateClientCommand(
            pin: $dto->pin,
            fullName: $dto->fullName,
            birthDate: new DateTimeImmutable($dto->birthDate),
            region: $dto->region,
            city: $dto->city,
            phone: $dto->phone,
            email: $dto->email,
            creditScore: $dto->creditScore,
            monthlyIncomeUsd: $dto->monthlyIncomeUsd,
        );

        $client = $this->handler->execute($cmd);

        return $this->json(['data' => $client], Response::HTTP_CREATED);
    }
}
