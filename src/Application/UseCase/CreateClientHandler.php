<?php

declare(strict_types=1);

namespace App\Application\UseCase;

use App\Application\DTO\ClientInformation;
use App\Application\DTO\CreateClientCommand;
use App\Domain\Client\Entity\ClientEntity;
use App\Domain\Client\Enum\Region;
use App\Domain\Client\Exception\ClientAlreadyExistsException;
use App\Domain\Client\Repository\ClientRepository;
use App\Domain\Client\ValueObject\EmailAddress;
use App\Domain\Client\ValueObject\PersonalIdentificationNumber;
use App\Domain\Client\ValueObject\PhoneNumber;
use App\Domain\Common\Service\IdGenerator;
use Doctrine\ORM\EntityManagerInterface;

final readonly class CreateClientHandler
{
    public function __construct(
        private ClientRepository $repository,
        private IdGenerator $idGenerator,
        private EntityManagerInterface $em,
    ) {}

    public function execute(CreateClientCommand $cmd): ClientInformation
    {
        $client = new ClientEntity(
            id: $this->idGenerator->generate(),
            pin: new PersonalIdentificationNumber($cmd->pin),
            fullName: $cmd->fullName,
            birthDate: $cmd->birthDate,
            region: Region::from($cmd->region),
            city: $cmd->city,
            phone: new PhoneNumber($cmd->phone),
            email: new EmailAddress($cmd->email),
            creditScore: $cmd->creditScore,
            monthlyIncomeUsd: $cmd->monthlyIncomeUsd,
        );

        $this->ensureClientDoesntExists($client);

        $this->repository->create($client);

        $this->em->wrapInTransaction(function () {
            $this->em->flush();
        });

        return ClientInformation::fromEntity($client);
    }

    private function ensureClientDoesntExists(ClientEntity $client): void
    {
        if ($this->repository->existsByPin($client->pin())) {
            throw new ClientAlreadyExistsException('Client PIN is already taken.');
        }

        if ($this->repository->existsByPhone($client->phone())) {
            throw new ClientAlreadyExistsException('Client Phone number is already taken.');
        }

        if ($this->repository->existsByEmail($client->email())) {
            throw new ClientAlreadyExistsException('Client Email address is already taken.');
        }
    }
}
