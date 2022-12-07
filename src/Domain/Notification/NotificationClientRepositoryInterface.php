<?php

declare(strict_types=1);

namespace Domain\Notification;

use Domain\Client\ClientRepositoryInterface;

interface NotificationClientRepositoryInterface
{
    public function add(NotificationClient $notificationClient): void;

    public function findByNotificationId(int $notificationId): ?NotificationClient;

    public function findByClientId(int $clientId): ?NotificationClient;

    public function findByNotificationIdAndClientId(int $notificationId, int $clientId): ?NotificationClient;
}
