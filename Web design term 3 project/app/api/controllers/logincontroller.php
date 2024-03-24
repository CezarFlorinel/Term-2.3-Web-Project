<?php

use App\Services\LoginService;
class LoginController
{

    private LoginService $loginService;

    // initialize services
    function __construct()
    {
        $this->loginService = new LoginService();
    }

    public function index()
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];
                echo "Email". $email;
                echo $password;
                // $postData = file_get_contents('php://input');
                // $user = json_decode($postData);
                // $name = $user->name;
                // $email = $user->email;
                // $password = $user->password;
                // $role = $user->role;

                // $user = $this->loginService->getUserByEmail($email);

                // if (password_verify($password, $user->getPassword())) {

                //     $_SESSION['user'] = [
                //         'name' => $name,
                //         'email' => $email,
                //         'role' => $role
                //     ];
                //     echo json_encode(['success' => true]);
                //     header("http://localhost");

                // } else {
                //     echo json_encode(['success' => false, 'message' => 'Incorrect email or password']);
                //     require __DIR__ . '/../views/login/index.php';
                // }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }


    }
}
