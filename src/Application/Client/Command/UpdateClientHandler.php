<?php

namespace Application\Client\Command;

use Domain\Client\ClientRepositoryInterface;

class UpdateClientHandler
{
    private ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function handle(int $id, UpdateClientCommand $command): void
    {
        $client = $this->clientRepository->findById($id);
        echo 'client' . $client->getFirstName() . PHP_EOL;
        if ($client === null) {
            throw new \RuntimeException('Client not found');
        }

        $this->clientRepository->save($client);
    }
}
