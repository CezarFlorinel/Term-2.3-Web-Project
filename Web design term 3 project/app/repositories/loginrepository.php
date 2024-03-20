<?php

namespace App\Repositories;

use App\Models\User;

use PDO;
use PDOException;

class LoginRepository extends Repository
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
    private function checkIfEmailExists($email): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as count_users FROM [USER] WHERE email = ?");
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['count_users'] > 0);
    }
    function getUserByEmail($email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE email = ?");
            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_CLASS);

            return $result ? $result : null;
        } catch (PDOException $e) {
            echo  "Error fetching user by email: " . $e->getMessage();
        }
    }
    //separate methods for update password, email, name and picture
    // public function update($user)
    // {
    //     try {
    //         $stmt = $this->connection->prepare("UPDATE [USER] SET email = :email, name = :name, role = :role, WHERE id = :id");

    //         $stmt->bindValue(':email', $user->getEmail());
    //         $stmt->bindValue(':name', $user->getName());
    //         $stmt->bindValue(':role', $user->getUserRole());
    //         $stmt->bindValue(':id', $user->getId());

    //         $stmt->execute();

    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }
    // public function delete($userId)
    // {
    //     try {
    //         $stmt = $this->connection->prepare("DELETE FROM user WHERE id = ?");

    //         $stmt->execute([$userId]);
    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }


}