<?php

namespace App\Repositories;

require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

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
            $stmt = $this->connection->prepare("SELECT * FROM [USER] WHERE id = ?");
            $stmt->execute([$userId]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getByEmail($email)
    {
        try{
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = ?");
            $stmt->execute([$email]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result ? $result : null;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function create($user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO [USER] (email, password, role, name) VALUES (?, ?, ?, ?)");

            $stmt->execute([
                $user->getEmail(),
                password_hash($user->getPassword(), PASSWORD_DEFAULT),
                $user->getUserRole(),
                $user->getName()
                // $user->getProfilePicture()
            ]);
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function update($user)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE [USER] SET email = :email, name = :name, role = :role, WHERE id = :id");

            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':role', $user->getUserRole());
            $stmt->bindValue(':id', $user->getId());

            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function delete($userId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user WHERE id = ?");
            
            $stmt->execute([$userId]);
        } catch (PDOException $e) {
            echo $e;
        }
    }
}