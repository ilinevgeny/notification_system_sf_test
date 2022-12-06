<?php

declare(strict_types=1);

namespace Domain\Notification;

use Domain\Client\Client;

class Notification
{
    public Client $client;
    public string $channel;
    public string $content;

    public function __construct(Client $client, string $channel, string $content)
    {
        $this->client = $client;
        $this->channel = $channel;
        $this->content = $content;
    }
}
