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
        $this->setEmail($email);
        $this->setName($name);
        $this->setPassword($password);
        $this->setUserRole(UserRole::Member);
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
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getUserRole() : string
    {
        return $this->role->name;
        //return $this->role;
    }
    public function setUserRole(UserRole $role)
    {
        $this->role = $role;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function getRegistrationDate(): \DateTime
    {
        return $this->registrationDate;
    }
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
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
