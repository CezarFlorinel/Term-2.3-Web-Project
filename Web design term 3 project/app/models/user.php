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
        $this->setEmail($userData['email'] ?? '');
        $this->setName($userData['name'] ?? '');
        $this->setPassword($userData['password'] ?? '');
        if(isset($userData['role'])) {
            $validRoles = [UserRole::Admin, UserRole::Member, UserRole::Employee];
            $this->setUserRole(in_array($userData['role'], $validRoles) ? $userData['role'] : UserRole::Member);
        } 
        // if (isset($userData['registrationDate'])) {
        //     // Assuming registration date is in 'Y-m-d' format, otherwise adjust the format accordingly
        //     $this->registrationDate = new \DateTime($userData['registrationDate']);
        // }
        // $this->setProfilePicture($userData['user_profile_picture'] ?? '');
    }
    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'role' => $this->role,
            'registrationDate' => $this->registrationDate->format('Y-m-d'),
        ];
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
        return $this->role->name;
    }
    public function setUserRole(UserRole $role): self
    {
        $this->role = $role;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
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
