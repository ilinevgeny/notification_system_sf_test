<?php

declare(strict_types=1);

namespace Infrastructure\Notification\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Notification\Notification;
use Domain\Notification\NotificationRepositoryInterface;

class OrmNotificationRepository extends ServiceEntityRepository implements NotificationRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notification::class);
    }

    public function findById(int $id): ?Notification
    {
        return $this->find($id);
    }

    public function add(Notification $notification): void
    {
        $this->getEntityManager()->persist($notification);
        $this->getEntityManager()->flush();
    }
}
