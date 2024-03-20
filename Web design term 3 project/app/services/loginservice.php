<?php

namespace App\Services;
use App\Repositories\LoginRepository;

class LoginService {

    private LoginRepository $loginRepository;
    function __construct()
    {
        $this->loginRepository = new LoginRepository;
    }
    public function getAllUsers() {
       // $users = $loginRepository->getAllUsers();
        return $this->loginRepository->getAllUsers();
    }
    public function getUserByEmail($email){
        return $this->loginRepository->getUserByEmail($email);

    }

}
