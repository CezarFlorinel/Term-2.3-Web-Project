<?php

namespace App\Models;
enum UserRole : string
{
    case Member = "Member";
    case Admin = "Admin";
    case Employee = "Employee";
}