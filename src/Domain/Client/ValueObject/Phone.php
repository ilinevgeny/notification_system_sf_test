<?php

declare(strict_types=1);

namespace Domain\Client\ValueObject;

class Phone
{
    private string $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
