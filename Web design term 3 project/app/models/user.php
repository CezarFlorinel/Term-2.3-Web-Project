<?php
namespace App\Models;

class User {
    public int $id;
    public string $email;
    public string $username;
    public string $password;
    public string $role; //do we need enum?
    public string $name;
    public ?string $profilePicture;

    public \DateTime $registrationDate;
}

