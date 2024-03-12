<?php

namespace App\Models;
enum UserRole
{
    case Member = "Member";
    case Admin = "Admin";
    case Employee = "Employee";
}