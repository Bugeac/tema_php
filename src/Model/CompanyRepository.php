<?php

namespace App\Model;

use PDOException;

class CompanyRepository extends Repository
{
    /**
     * @param string $name
     * @param string $date
     * @param string $vat
     * @return bool
     */
    public function save(string $name, string $date, string $vat)
    {
        $sql = "INSERT INTO
            company(name, date, vat)
            VALUES (:name, :date, :vat)
        ";
        try {
            $query = $this->pdo->prepare($sql);
            $query->execute([
                ':name' => $name,
                ':date' => $date,
                ':vat' => $vat,
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}