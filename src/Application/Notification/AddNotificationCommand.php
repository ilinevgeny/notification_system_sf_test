<?php

declare(strict_types=1);

namespace Application\Notification;

class AddNotificationCommand
{
    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
