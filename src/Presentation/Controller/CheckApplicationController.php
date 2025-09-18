<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\DTO\CheckApplicationCommand;
use App\Application\UseCase\CheckApplicationHandler;
use App\Presentation\DTO\LoanApplicationDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class CheckApplicationController extends AbstractController
{
    public function __construct(
        private readonly CheckApplicationHandler $handler,
    ) {
    }

    #[Route('/loans/application', name: 'app_loan_application', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] LoanApplicationDTO $dto,
    ): Response {
        $cmd = new CheckApplicationCommand(
            clientId: $dto->clientId,
            amountUsd: $dto->amountUsd,
            periodDays: $dto->periodDays,
        );

        $loanApplicationResult = $this->handler->execute($cmd);

        return $this->json(['data' => $loanApplicationResult]);
    }
}
