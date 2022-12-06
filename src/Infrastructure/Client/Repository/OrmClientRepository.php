<?php

declare(strict_types=1);

namespace  Infrastructure\Client\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Client\Client;
use Domain\Client\ClientRepositoryInterface;

class OrmClientRepository extends ServiceEntityRepository implements ClientRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }
    public function findById(int $id): ?Client
    {
        return $this->find($id);
    }

    public function findByEmail(string $email): ?Client
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function findByPhone(string $phone): ?Client
    {
        return $this->findOneBy(['phone' => $phone]);
    }

    public function save(Client $client): void
    {
        $this->getEntityManager()->persist($client);
        $this->getEntityManager()->flush();
    }
}
