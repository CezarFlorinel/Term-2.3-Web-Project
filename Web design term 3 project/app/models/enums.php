<?php

namespace App\Models;
enum UserRole: string
{
    case Member;
    case Admin;
    case Employee;
}