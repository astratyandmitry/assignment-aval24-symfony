<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\CheckApplicationResult;
use App\Application\DTO\LoanInformation;
use App\Application\Shared\EventBus;
use App\Domain\Client\Entity\ClientEntity;
use App\Domain\Client\Exception\ClientNotFoundException;
use App\Domain\Client\Repository\ClientRepository;
use App\Domain\Common\Service\IdGenerator;
use App\Domain\Loan\Entity\LoanEntity;
use App\Domain\Loan\Event\LoanDeclined;
use App\Domain\Loan\Event\LoanIssued;
use App\Domain\Loan\Exception\LoanPolicyException;
use App\Domain\Loan\Repository\LoanRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

final readonly class LoanIssueHandler
{
    public function __construct(
        private LoanRepository $loanRepository,
        private ClientRepository $clientRepository,
        private IdGenerator $idGenerator,
        private EntityManagerInterface $em,
        private EventBus $eventBus,
    ) {
    }

    public function execute(CheckApplicationResult $cmd): LoanInformation
    {
        if (! ($client = $this->clientRepository->findById($cmd->clientId)) instanceof ClientEntity) {
            throw new ClientNotFoundException('Client not found by given ID');
        }

        if (! $cmd->allowed) {
            $this->dispatchDeclinedEvent($client->id(), $cmd->denyReason);

            throw new LoanPolicyException($cmd->denyReason);
        }

        $today = new DateTimeImmutable();

        $loan = new LoanEntity(
            id: $this->idGenerator->generate(),
            client: $client,
            name: 'Personal Credit',
            amountUsd: $cmd->amountUsd,
            periodDays: $cmd->periodDays,
            interestRate: $cmd->interestRate,
            startDate: $today,
            endDate: $today->modify(sprintf('+%d days', $cmd->periodDays)),
        );

        $this->loanRepository->create($loan);

        $this->em->wrapInTransaction(function () {
            $this->em->flush();
        });

        $this->dispatchIssuedEvent($client->id(), $loan->id());

        return LoanInformation::fromEntity($loan);
    }

    private function dispatchDeclinedEvent(string $clientId, string $denyReason): void
    {
        $this->eventBus->publish(
            new LoanDeclined(
                clientId: $clientId,
                denyReason: $denyReason,
            )
        );
    }

    private function dispatchIssuedEvent(string $clientId, string $loanId): void
    {
        $this->eventBus->publish(
            new LoanIssued(
                loanId: $loanId,
                clientId: $clientId,
            )
        );
    }
}
