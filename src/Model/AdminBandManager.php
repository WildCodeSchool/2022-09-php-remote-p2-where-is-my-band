<?php

namespace App\Model;

use PDO;

class AdminBandManager extends AbstractManager
{
    public const TABLE = 'band';

    /**
     * Insert new item in database
     */
    public function insert(array $band)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (name, description, number, email, picture, localisation_id) VALUES
        (:name, :description, :number, :email, :picture, :localisation_id)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $band['name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $band['description'], PDO::PARAM_STR);
        $statement->bindValue(':number', $band['number'], PDO::PARAM_STR);
        $statement->bindValue(':email', $band['email'], PDO::PARAM_STR);
        $statement->bindValue(':picture', $band['picture'], PDO::PARAM_STR);
        $statement->bindValue(':localisation_id', $band['localisation_id'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
}
