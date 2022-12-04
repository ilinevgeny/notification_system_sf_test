<?php

declare(strict_types=1);

namespace Infrastructure\Client\Dto;

use Domain\Client\Client;

class ViewActionDto
{
    public int $clientId;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $phone;

    public function __construct(Client $client)
    {
        $this->clientId = $client->getId();
        $this->firstName = $client->getFirstName();
        $this->lastName = $client->getLastName();
        $this->email = $client->getEmail();
        $this->phone = $client->getPhone();
    }
}
