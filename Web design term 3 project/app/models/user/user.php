<?php

namespace App\Models\User;

use App\Models\User\UserRole;

class User
{
    private int $id;
    private string $email;
    private string $password;
    private UserRole $role;
    private string $name;
    private ?string $profilePicture;
    private ?\DateTime $registrationDate;

    public function __construct(array $userData)
    {
        $this->setId($userData['userID'] ?? 0);
        $this->setEmail($userData['email'] ?? '');
        $this->setName($userData['name'] ?? '');
        $this->setPassword($userData['password'] ?? '');
        $this->setUserRole($userData['role'] ?? '');
        $this->registrationDate = new \DateTime($userData['registrationDate'] ?? 'now');
        $this->setProfilePicture($userData['userProfilePicture'] ?? '');
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'role' => $this->role,
            'registrationDate' => $this->registrationDate->format('Y-m-d'),
            'userProfilePicture' => $this->profilePicture
        ];
    }

    private function setUserRole(string $role): void
    {
        if ($role === 'Admin') {
            $this->role = UserRole::Admin;
        } else if ($role === 'Employee') {
            $this->role = UserRole::Employee;
        } else {
            $this->role = UserRole::Member;
        }
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getUserRole(): string
    {
        return $this->role->value;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    public function getRegistrationDate(): \DateTime
    {
        return $this->registrationDate;
    }

    public function getProfilePicture(): string
    {
        return $this->profilePicture;
    }
    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }
}
