<?php

declare(strict_types=1);

namespace Domain\Client;

class Client
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phone;

    public function __construct(string $firstName, string $lastName, string $email, string $phone)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
