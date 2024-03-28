<?php

namespace App\Api\Controllers;

use App\Services\UserService;
use App\Models\User;

class UserController
{
    private $userService;

    private $filters = [
        'email' => FILTER_SANITIZE_EMAIL,
        'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'role' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        // 'registrationDate' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
    ];


    function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->create();
        } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = $_GET['id'] ?? null;

            if ($id !== null) {
                $this->getById($id);
            } else {
                $this->getAllUsers();
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->update();
        } elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->delete();
        }
    }

    public function getAllUsers()
    {
        $users = $this->userService->getAllUsers();
        echo json_encode(['status' => 'success', 'data' => $users]);
    }

    public function getById($userId)
    {
        $user = $this->userService->getById($userId);

        if ($user) {
            echo json_encode(['status' => 'success', 'data' => $user]);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'User not found']);
        }
    }

    public function create()
    {
        $jsonInput = file_get_contents('php://input');
        $data = json_decode($jsonInput, true);
        
        if ($data !== null) {
            $sanitizedData = filter_var_array($data, $this->filters, false);

            if ($sanitizedData !== false && !in_array(false, $sanitizedData, true)) {
                $user = new User($sanitizedData);

                $this->userService->createUser($user);

                echo json_encode(['status' => 'success', 'message' => 'User created successfully']);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
        }
    }

    public function update()
    {
        $jsonInput = file_get_contents('php://input');
        $data = json_decode($jsonInput, true);

        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $existingUser = $this->userService->getById($userId);

            if ($existingUser) {
                if ($data !== null) {
                    $sanitizedData = filter_var_array($data, $this->filters, false);

                    if ($sanitizedData !== false && !in_array(false, $sanitizedData, true)) {
                        $updatedUser = new User($sanitizedData);
                        $updatedUser->setId($userId);

                        $this->userService->update($updatedUser);

                        http_response_code(200);
                        echo json_encode(['status' => 'success', 'message' => 'User updated successfully', 'user' => $updatedUser->toArray()]);
                    } else {
                        http_response_code(400);
                        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
                }
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'User not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing User ID']);
        }
    }

    public function delete()
    {
        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $existingUser = $this->userService->getById($userId);

            $this->userService->delete($userId);

            if ($existingUser) {
                http_response_code(204);
                echo json_encode(['status' => 'success', 'message' => 'User deleted successfully']);
                $existingUser = null;
            } else {
                http_response_code(404);
                echo json_encode(['status' => 'error', 'message' => 'User not found or already deleted']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing user ID']);
        }
    }
}
?>