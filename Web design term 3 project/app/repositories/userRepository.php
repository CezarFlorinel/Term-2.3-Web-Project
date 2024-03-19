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
    public function getById($userId)//: ?User Convert the response to a User object.
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE UserID = ?");
            $stmt->execute([$userId]);
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    //private and use it when you create user.
    private function checkIfEmailExists($email): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) as count_users FROM [USER] WHERE email = ?");
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return($result['count_users'] > 0);
    }
    function createUser(User $user): void
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO [USER] (Email, Password, Role, Name) VALUES (?, ?, ?, ?)");

            $stmt->execute([
                $user->getEmail(),
                $user->getPassword(),
                $user->getUserRole(),
                $user->getName()
                // $user->getProfilePicture()
            ]);
        } catch (PDOException $e) {
            echo $e;
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

        
    // function getByEmail($email): ?string
    // {
    //     try{
    //         $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE email = ?");
    //         $stmt->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
    //         $stmt->execute([$email]);

    //         $result = $stmt->fetch(PDO::FETCH_CLASS);

    //         return $result ? $result : null;
    //     } catch (PDOException $e) {
    //         echo $e;
    //     }
    // }

}