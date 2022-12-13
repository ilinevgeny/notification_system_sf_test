<?php

declare(strict_types=1);

namespace Application\Notification;

class AddNotificationCommand
{
    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }
}
