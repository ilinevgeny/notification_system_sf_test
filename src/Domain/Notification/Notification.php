<?php

declare(strict_types=1);

namespace Domain\Notification;

class Notification
{
    private int $id;
    public string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }
}
