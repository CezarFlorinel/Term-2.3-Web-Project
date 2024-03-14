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
    private \DateTime $registrationDate;

    public function __construct(string $email, string $name, string $password, UserRole $role)
    {
        $this->setEmail($email['email'] ?? '');
        $this->setName($name['name'] ?? '');
        $this->setPassword($password['password'] ?? '');
        $this->setUserRole($role ?? UserRole::Member);
        //$this->setRegistrationDate($registrationDate);
        // $this->setProfilePicture($userData['user_profile_picture'] ?? '');
    }
    public function getId(): int
    {
        return $this->id;
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
    public function getUserRole(): UserRole
    {
        return $this->role;
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
    public function setRegistrationDate($registrationDate)
    {
        return $this->registrationDate = $registrationDate;
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
