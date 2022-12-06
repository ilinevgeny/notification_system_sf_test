<?php

declare(strict_types=1);

namespace Application\Client\Command;

class UpdateClientCommand
{
    private int $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $phone;

    public function __construct(
        int $id,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $email  = null,
        ?string $phone  = null
    )
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

   public function getId(): int
   {
       return $this->id;
   }
}
