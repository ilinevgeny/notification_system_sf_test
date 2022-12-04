<?php

declare(strict_types=1);

namespace Domain\Admin;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Domain\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;

class Admin implements UserInterface
{
    private int $id;
    private string $email;
    private string $firstName;
    private string $lastName;
    private ?string $password;
    private Collection $roles;

    public function __construct(
        string $email,
        string $firstName,
        string $lastName
    ) {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->roles = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getRolesIds(): array
    {
        $rolesIds = [];

        /** @var Role $role */
        foreach ($this->roles as $role) {
            $rolesIds[] = $role->getId();
        }

        return $rolesIds;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function addRole(Role $role): void
    {
        if ($this->roles->contains($role)) {
            return;
        }

        $this->roles->add($role);
        $role->addAdmin($this);
    }

    public function removeRole(Role $role): void
    {
        if (!$this->roles->contains($role)) {
            return;
        }

        $this->roles->removeElement($role);
        $role->removeAdmin($this);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function encodePassword(string $password): void
    {
        $this->password = $password;
    }

    public function update(
        string $email,
        string $firstName,
        string $lastName
    ): void {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->updatedAt = new \DateTime();
    }

    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
    }
}
