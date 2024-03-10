<?php

namespace App\Models;

require '../models/enums.php';

class User {
    public int $id;
    public string $email;
    public string $password;
    public UserRole $role; 
    public string $name;
    public ?string $profilePicture;
    public \DateTime $registrationDate;
}

