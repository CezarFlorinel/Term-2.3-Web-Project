<?php

namespace App\Repositories;

use PDO;

class UserRepository extends Repository
{
    public function getUsers()
    {
        $stmt = $this->connection->prepare("SELECT * FROM [USER]");
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}