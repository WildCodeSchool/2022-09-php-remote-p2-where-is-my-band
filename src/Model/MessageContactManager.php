<?php

namespace App\Model;

use PDO;

class MessageContactManager extends AbstractManager
{
    public const TABLE = 'message_contact';

    /**
     * Insert new item in database
     */
    public function insert(array $messageContact)
    {
        $query = 'INSERT INTO ' . self::TABLE . ' (lastname, firstname, email, phone, message) VALUES
        (:lastname, :firstname, :email, :phone, :message)';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':lastname', $messageContact['lastname'], PDO::PARAM_STR);
        $statement->bindValue(':firstname', $messageContact['firstname'], PDO::PARAM_STR);
        $statement->bindValue(':email', $messageContact['email'], PDO::PARAM_STR);
        $statement->bindValue(':phone', $messageContact['phone'], PDO::PARAM_STR);
        $statement->bindValue(':message', $messageContact['message'], PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

}
