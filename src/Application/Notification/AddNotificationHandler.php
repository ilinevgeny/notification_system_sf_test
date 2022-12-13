<?php

declare(strict_types=1);

namespace Application\Notification;

use Domain\Notification\Notification;
use Domain\Notification\NotificationRepositoryInterface;

class AddNotificationHandler
{
    private NotificationRepositoryInterface $notificationRepository;
    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handle(AddNotificationCommand $command): void
    {
        //do something with payload
//        print_r($command->payload['message']['text']);
        $notifcation = new Notification($command->payload['message']['text']['email']['en']);
        $this->notificationRepository->add($notifcation);
    }
}
