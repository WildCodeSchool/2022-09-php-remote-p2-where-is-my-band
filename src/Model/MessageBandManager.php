<?php

namespace App\Model;

use PDO;

class MessageBandManager extends AbstractManager
{
    public const TABLE = 'message_band';

    /**
     * Insert new item in database
     */
    public function insert(array $messageBand)
    {
        $query = 'INSERT INTO ' . self::TABLE .
            '(lastname, firstname, instrument, level, style, localisation, email, phone, message) 
            VALUES (:lastname, :firstname, :instrument, :level, :style, :localisation, :email, :phone, :message)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':lastname', $messageBand['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $messageBand['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':instrument', $messageBand['instrument'], PDO::PARAM_STR);
        $statement->bindValue(':level', $messageBand['level'], PDO::PARAM_STR);
        $statement->bindValue(':style', $messageBand['style'], PDO::PARAM_STR);
        $statement->bindValue(':localisation', $messageBand['localisation'], PDO::PARAM_STR);
        $statement->bindValue(':email', $messageBand['email'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $messageBand['phone'], PDO::PARAM_STR);
        $statement->bindValue(':message', $messageBand['message'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }
}
