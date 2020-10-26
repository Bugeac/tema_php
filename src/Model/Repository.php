<?php

namespace App\Model;

use PDO;
use PDOException;

abstract class Repository
{

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    /**
     * Method used to get everything from a specific table.
     * @param string   $table The name of the table.
     * @param int|null $limit (optional) A limit, if it's necessary.
     * @return array|false
     */
    public function findAll(string $table, ?int $limit = null)
    {
        $sql = "SELECT * FROM {$table}";
        if ($limit !== null) {
            $sql .= " LIMIT {$limit}";
        }
        try {
            $query = $this->pdo->query($sql);
            return $query->fetchAll();
        } catch (PDOException $e) {
//          perhaps log the error or throw an exception
            return false;
        }
    }
}