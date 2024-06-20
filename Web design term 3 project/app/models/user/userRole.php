<?php

namespace App\Models\User;
enum UserRole : string
{
    case Member = "Member";
    case Admin = "Admin";
    case Employee = "Employee";
}