<?php

namespace Application\Client\Command;

use Domain\Client\ClientRepositoryInterface;
use RuntimeException;

class UpdateClientHandler
{
    private ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function handle(UpdateClientCommand $command): void
    {
        $client = $this->clientRepository->findById($command->getId());

        if ($client === null) {
            throw new RuntimeException('Client not found');
        }

        $props = array_filter(get_object_vars($command));

        if (isset($props['email']) && $props['email'] !== $command->email) {
            $this->checkEmailExists($command->email);
        }

        foreach ($props as $prop => $value) {
            echo 'value ==> '. $value . PHP_EOL;
            $client->{'set' . ucfirst($prop)}($value);
        }

        try {
            $this->clientRepository->save($client);
        } catch (\Exception $e) {
            throw new RuntimeException('Error saving client');
        }
    }

    private function checkEmailExists(string $email): void
    {
        $client = $this->clientRepository->findByEmail($email);
        if ($client) {
            throw new RuntimeException('Client with this email already exist');
        }
    }

    private function checkPhoneExists(string $phone): void
    {
        $client = $this->clientRepository->findByPhone($phone);
        if ($client) {
            throw new \RuntimeException('Client with this phone already exist');
        }
    }
}
