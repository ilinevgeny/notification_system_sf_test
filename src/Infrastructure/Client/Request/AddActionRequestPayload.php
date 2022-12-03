<?php

declare(strict_types=1);

namespace Infrastructure\Client\Request;

use Infrastructure\Common\Http\RequestPayload;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

class AddActionRequestPayload implements RequestPayload
{
/**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=32)
     */
    public string $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=32)
     */
    public string $lastName;

    /**
     * @Assert\NotBlank()
     * @AssertPhoneNumber(defaultRegion="LV")
     */
    public string $phone;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public string $email;

    public function fillFromPayload(array $payload): void
    {
        if (isset($payload['firstName'])) {
            $this->firstName = $payload['firstName'];
        }

        if (isset($payload['lastName'])) {
            $this->lastName = $payload['lastName'];
        }

        if (isset($payload['phone'])) {
            $this->phone = $payload['phone'];
        }

        if (isset($payload['email'])) {
            $this->email = $payload['email'];
        }
    }
}
