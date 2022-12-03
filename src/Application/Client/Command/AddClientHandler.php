<?php

declare(strict_types=1);

namespace Application\Client\Command;

use Domain\Client\Client;
use Domain\Client\ClientRepositoryInterface;

class AddClientHandler
{
    private ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function handle(AddClientCommand $command): void
    {
        $client = new Client(
            $command->getFirstName(),
            $command->getLastName(),
            $command->getEmail(),
            $command->getPhone()
        );

        $this->clientRepository->save($client);
    }
}
