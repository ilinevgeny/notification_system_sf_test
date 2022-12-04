<?php

namespace Infrastructure\Admin\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Admin\Admin;
use Domain\Admin\AdminRepository;

class OrmAdminRepository extends ServiceEntityRepository implements AdminRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admin::class);
    }

    public function save(Admin $admin): void
    {
        $this->getEntityManager()->persist($admin);
        $this->getEntityManager()->flush();
    }

    public function findById(int $id): ?Admin
    {
        $admin = $this->find($id);

        if (!$admin instanceof Admin) {
            return null;
        }

        return $admin;
    }

    public function findByEmail(string $email): ?Admin
    {
        $admin = $this->findOneBy(['email' => $email]);

        if (!$admin instanceof Admin) {
            return null;
        }

        return $admin;
    }
}
