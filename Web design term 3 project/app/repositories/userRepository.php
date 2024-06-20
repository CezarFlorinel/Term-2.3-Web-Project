<?php

namespace App\Repositories;

use App\Models\User;

use PDO;
use PDOException;

class UserRepository extends Repository
{
    function getAllUsers()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM [USER]");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function getById($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE UserID = :id");
            $stmt->bindValue(':id', $userId, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $resultArray = $this->convertKeysToCamelCase($result);
                return $resultArray;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    function getByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE Email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $resultArray = $this->convertKeysToCamelCase($result);
                return $resultArray;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            return null;
        }
    }
    private function convertKeysToCamelCase($array)
    {
        $camelCaseArray = [];
        foreach ($array as $key => $value) {
            // Convert first character to lowercase
            $camelCaseKey = lcfirst($key);
            $camelCaseArray[$camelCaseKey] = $value;
        }
        return $camelCaseArray;
    }

    public function checkIfEmailExists($email): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as count_users FROM [USER] WHERE Email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count_users'] > 0;
    }
    function createUser($user)
    {
        try {
            //add validation
            $stmt = $this->connection->prepare("INSERT INTO [USER] (Email, Password, Role, Name) VALUES (:email, :password, :role, :name)");

            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':role', $user->getUserRole());

            $stmt->execute();

        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update($user)
    {
        try {
            $query = "UPDATE [USER] SET Email = :email, Name = :name, Role = :role";
            $params = [
                ':email' => $user->getEmail(),
                ':name' => $user->getName(),
                ':role' => $user->getUserRole(),
            ];

            // Check if password is provided
            if ($user->getPassword() !== '') {
                $query .= ", Password = :password";
                $params[':password'] = $user->getPassword();
            }

            $query .= " WHERE UserID = :id";

            $stmt = $this->connection->prepare($query);

            foreach ($params as $param => $value) {
                $stmt->bindValue($param, $value);
            }

            $stmt->bindValue(':id', $user->getId());

            $stmt->execute();

        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    public function delete($userId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM [USER] WHERE UserID = :id");
            $stmt->bindValue(':id', $userId, PDO::PARAM_STR);
            $stmt->execute();

        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function checkIfKeyExists($key): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) AS count_keys FROM PASSWORD_RESET_KEY WHERE ResetKey = :key");
        $stmt->bindValue(':key', $key, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count_keys'] > 0;
    }

    public function deleteKey($key)
    {
        $stmt = $this->connection->prepare("DELETE FROM PASSWORD_RESET_KEY WHERE ResetKey = :key");
        $stmt->bindValue(':key', $key, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insertKeyUnique($userId): int
    {
        $uniqueKey = rand(100000, 999999);

        while ($this->checkIfKeyExists($uniqueKey)) {
            $uniqueKey = rand(100000, 999999);
        }

        $stmt = $this->connection->prepare("INSERT INTO PASSWORD_RESET_KEY (UserID, ResetKey) VALUES (:userId, :key)");
        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':key', $uniqueKey, PDO::PARAM_INT);
        $stmt->execute();

        return $uniqueKey;
    }

    public function returnUserKey($userID): ?int
    {
        $stmt = $this->connection->prepare("SELECT ResetKey FROM PASSWORD_RESET_KEY WHERE UserID = :userID");
        $stmt->bindValue(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['ResetKey'];
    }

    public function changePassword($userID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->connection->prepare("UPDATE [USER] SET Password = :newPassword WHERE UserID = :userID");
        $stmt->bindValue(':newPassword', $newPassword);
        $stmt->bindValue(':userID', $userID);
        $stmt->execute();
    }

}