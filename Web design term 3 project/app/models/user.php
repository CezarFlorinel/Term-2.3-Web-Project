<?php

namespace App\Models;

require '../models/enums.php';

class User implements \JsonSerializable
{
    public int $id;
    public string $email;
    public string $password;
    public UserRole $role;
    public string $name;
    // public ?string $profilePicture;
    public \DateTime $registrationDate;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

    public function __construct(array $userData)
    {
        $this->setEmail($userData['email'] ?? '');
        $this->setName($userData['name'] ?? '');
        $this->setPassword($userData['password'] ?? '');
        $this->setUserRole($userData['user_role'] ?? '');
        // $this->setProfilePicture($userData['user_profile_picture'] ?? '');
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'name' => $this->name,
            'password' => $this->password,
            'user_role' => $this->role,
            // 'user_profile_picture' => $this->profilePicture,
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
        $this->password = $password;

        return $this;
    }
    public function getRegistrationDate(): \DateTime
    {
        return $this->registrationDate;
    }
    public function setRegistrationDate(\DateTime $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
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

?>

