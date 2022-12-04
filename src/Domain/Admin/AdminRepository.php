<?php

namespace Domain\Admin;

interface AdminRepository
{
    public function save(Admin $admin): void;
    public function findById(int $id): ?Admin;
    public function findByEmail(string $email): ?Admin;
}
