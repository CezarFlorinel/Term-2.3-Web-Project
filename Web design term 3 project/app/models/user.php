<?php

namespace App\Models;

use App\Models\UserRole;

class User
{
    private int $id;
    private string $email;
    private string $password;
    private UserRole $role;
    private string $name;
    //private ?string $profilePicture;
    private ?\DateTime $registrationDate;

    public function __construct(array $userData)
    {
        $this->setId($userData['UserID'] ?? 0);
        $this->setEmail($userData['Email'] ?? '');
        $this->setName($userData['Name'] ?? '');
        $this->setPassword($userData['Password'] ?? '');
        $this->setUserRole($userData['Role'] ?? '');
        $this->registrationDate = new \DateTime($userData['RegistrationDate'] ?? 'now');
        // $this->setProfilePicture($userData['user_profile_picture'] ?? '');
    }
    public function toArray(): array
    {
        return [

            'Email' => $this->email,
            'Name' => $this->name,
            'Password' => $this->password,
            'Role' => $this->role,
            'RegistrationDate' => $this->registrationDate->format('Y-m-d'),
        ];
    }

    private function setUserRole(string $role): void
    {
        if ($role === 'admin') {
            $this->role = UserRole::Admin;
        } else if ($role === 'employee') {
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

    //     public function getProfilePicture(): string
//     {
//         return $this->profilePicture;
//     }
//     public function setProfilePicture(string $profilePicture): self
//     {
//         $this->profilePicture = $profilePicture;

    //         return $this;
//     }
}
