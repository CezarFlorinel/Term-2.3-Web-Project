<?php
namespace App\Controllers;

use App\Services\UserService;
use App\Models\User;
use App\Models\UserRole;
use PDO;
use PDOException;

//session_start();
class RegisterController
{
    private UserService $userService;
    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        require __DIR__ . '/../views/login/register.php';
    }

    public function createAccount()
    { 
        session_start();


        $email = filter_var($_POST['email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$role = filter_var($_POST['role'] ?? UserRole::Member, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $registrationDate = filter_var($_POST['registrationDate'] ?? (new \DateTime())->format('Y-m-d'), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // if ($this->userService->checkIfEmailExists($email)) {
            
        // } else {
           
            $user = new User($email, $name, $password, UserRole::Member);
            $this->userService->createUser($user);
            // try {
            //     $this->userService->createUser($user);
            //     //header("Location: http://localhost/");
                
            //     exit();
            // } catch (PDOException $e) {
            //     echo $e;
            // }
        //}
    }
        //my old code

        // $email = ($_POST['email']);
        // $password = ($_POST['password']);
        // $name = ($_POST['name']);
        // $role = ($_POST['role'] ?? UserRole::Member);
        // $registrationDate = ($_POST['registrationDate'] ?? (new \DateTime())->format('Y-m-d'));
        // $user = new User($email, password_hash($password, PASSWORD_DEFAULT), $name, $role, $registrationDate);
        // $this->userService->createUser($user);

        // echo json_encode($user);
    }

    // public function edit()
    // {
    //     $this->checkUserRole('/../views/user/edit.php');
    // }

    // private function checkUserRole(string $path)
    // {
    //     if (isset($_SESSION['user'])) {
    //         if ($_SESSION['user']['user_role_id'] == 2) {
    //             require __DIR__ . $path;
    //         } else {
    //             http_response_code(403);
    //             echo 'Forbidden';
    //             exit();
    //         }
    //     } else {
    //         http_response_code(404);
    //         echo 'Not Found';
    //         exit();
    //     }
    // }


