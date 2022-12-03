<?php

declare(strict_types=1);

namespace Domain\Client;

interface ClientRepositoryInterface
{
     public function findById(int $id): ?Client;
}
