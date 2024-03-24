<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private UserRepository $userRepository;
    function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getById($userId)
    {
        return $this->userRepository->getById($userId);
    }

    function getByEmail($email)
    {
        return $this->userRepository->getByEmail($email);
    }
    public function checkIfEmailExists($email)
    {
        return $this->userRepository->checkIfEmailExists($email);
    }
    public function createUser($user)
    {
        return $this->userRepository->createUser($user);
    }

    public function update($user)
    {
        return $this->userRepository->update($user);
    }

    public function delete($userId)
    {
        return $this->userRepository->delete($userId);
    }
}

?>