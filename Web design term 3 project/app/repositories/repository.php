<?php
namespace App\Repositories;

use PDO;
use PDOException; // Make sure to include this for handling PDO exceptions

class Repository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            // For SQL Server, the DSN format is "sqlsrv:Server=hostname;Database=database"
            $dsn = "$type:Server=$servername;Database=$database";
            $this->connection = new PDO($dsn, $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}