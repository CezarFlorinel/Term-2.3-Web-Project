<?php

namespace App\Models;
enum UserRole: string
{
    case MEMBER;
    case ADMIN;
    case EMPLOYEE;
}