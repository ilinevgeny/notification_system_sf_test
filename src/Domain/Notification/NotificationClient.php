<?php

declare(strict_types=1);

namespace Domain\Notification;

class NotificationClient
{
    private int $id;
    private int $notificationId;
    private Notification $notification;
    private int $clientId;
    private Client $client;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNotificationId(): int
    {
        return $this->notificationId;
    }

    public function getNotification(): Notification
    {
        return $this->notification;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
