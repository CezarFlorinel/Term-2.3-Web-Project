<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    public function getAllUsers()
    {
        $repository = new UserRepository();
        return $repository->getAllUsers();
    }

    public function getById($userId)
    {
        $repository = new UserRepository();
        return $repository->getById($userId);
    }

    function getByEmail($email)
    {
        $repository = new UserRepository();
        return $repository->getByEmail($email);
    }

    public function createUser($user)
    {
        $repository = new UserRepository();
        $repository->create($user);
    }

    public function update($user)
    {
        $repository = new UserRepository();
        $repository->update($user);
    }

    public function delete($userId)
    {
        $repository = new UserRepository();
        $repository->delete($userId);
    }
}

?>