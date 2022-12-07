<?php

declare(strict_types=1);

namespace Domain\Notification;

interface NotificationRepositoryInterface
{
    public function add(Notification $notification): void;

    public function findById(int $id): ?Notification;
}
