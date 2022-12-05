<?php

declare(strict_types=1);

namespace Infrastructure\Client\Request;

use Infrastructure\Common\Http\RequestPayload;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

class UpdateActionRequestPayload implements RequestPayload
{
    /**
     * @Assert\Type("integer")
     * @Assert\NotBlank()
     */
    public int $id;

    /**
     * @Assert\Length(min=2, max=32)
     */
    public ?string $firstName;

    /**
     * @Assert\Length(min=2, max=32)
     */
    public ?string $lastName;

    /**
     * @AssertPhoneNumber(defaultRegion="LV")
     */
    public ?string $phone;

    /**
     * @Assert\Email()
     */
    public ?string $email;

    public function fillFromPayload(array $payload): void
    {
        if (isset($payload['id'])) {
            $this->id = $payload['id'];
        }

        $this->firstName = $payload['firstName'] ?? null;
        $this->lastName = $payload['lastName'] ?? null;
        $this->phone = $payload['phone'] ?? null;
        $this->email = $payload['email'] ?? null;
    }
}
