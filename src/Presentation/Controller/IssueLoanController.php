<?php

declare(strict_types=1);

namespace App\Presentation\Controller;

use App\Application\DTO\CheckApplicationCommand;
use App\Application\UseCase\CheckApplicationHandler;
use App\Application\UseCase\LoanIssueHandler;
use App\Presentation\DTO\LoanApplicationDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class IssueLoanController extends AbstractController
{
    public function __construct(
        private readonly CheckApplicationHandler $checkApplicationHandler,
        private readonly LoanIssueHandler $issueLoanHandler,
    ) {
    }

    #[Route('/loans/issue', name: 'app_loan_issue', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] LoanApplicationDTO $dto,
    ): Response {
        $cmd = new CheckApplicationCommand(
            clientId: $dto->clientId,
            amountUsd: $dto->amountUsd,
            periodDays: $dto->periodDays,
        );

        $loanApplicationResult = $this->checkApplicationHandler->execute($cmd);

        $loan = $this->issueLoanHandler->execute($loanApplicationResult);

        return $this->json(['data' => $loan], Response::HTTP_CREATED);
    }
}
