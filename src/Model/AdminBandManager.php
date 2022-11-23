<?php

namespace App\Model;

use PDO;

class AdminBandManager extends AbstractManager
{
    public const TABLE = 'band';
    public const TABLE2 = 'search_instrument';


    /**
     * Insert new item in database
     */
    public function insert(array $band)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (name, description, number, email, picture, localisation_id, style) 
        VALUES (:name, :description, :number, :email, :picture, :localisation_id, :style)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $band['name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $band['description'], PDO::PARAM_STR);
        $statement->bindValue(':number', $band['number'], PDO::PARAM_STR);
        $statement->bindValue(':email', $band['email'], PDO::PARAM_STR);
        $statement->bindValue(':picture', $band['file'], PDO::PARAM_STR);
        $statement->bindValue(':localisation_id', $band['localisation_id'], PDO::PARAM_INT);
        $statement->bindValue(':style', $band['style'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function updateBand(array $band)
    {
        $query = 'UPDATE ' . self::TABLE .
            ' SET name = :name, description = :description, number = :number, email = :email,
        localisation_id = :localisation_id, picture =:picture WHERE id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $band['id'], PDO::PARAM_INT);
        $statement->bindValue(':name', $band['name'], PDO::PARAM_STR);
        $statement->bindValue(':description', $band['description'], PDO::PARAM_STR);
        $statement->bindValue(':number', $band['number'], PDO::PARAM_INT);
        $statement->bindValue(':email', $band['email'], PDO::PARAM_STR);
        $statement->bindValue(':picture', $band['file'], PDO::PARAM_STR);
        $statement->bindValue(':localisation_id', $band['localisation_id'], PDO::PARAM_INT);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }


    public function insertAnnonce(array $annonce)
    {
        $query = 'INSERT INTO ' . self::TABLE2 . ' (created_at, instrument_id, band_id, level) VALUES
        (NOW(), :instrument_id, :band, :level)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':instrument_id', $annonce['instrument'], PDO::PARAM_INT);
        $statement->bindValue(':level', $annonce['level'], PDO::PARAM_STR);
        $statement->bindValue(':band', $annonce['band_id'], PDO::PARAM_INT);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
}
