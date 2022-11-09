<?php

namespace App\Model;

use PDO;

class BandManager extends AbstractManager
{
    public const TABLE = 'band';

    public function selectAllByQuery(array $search): array
    {
        /**
         * array $search:
         * - style
         * - instrument
         * - level
         * - localisation
         *
         */
        $query = 'SELECT * FROM band AS b RIGHT JOIN localisation AS l WHERE b.localisation_id=:localisation_id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':localisation', $search['localisation_id'], PDO::PARAM_STR);
        $statement->execute();

        $query = 'SELECT * FROM instrument AS i RIGHT JOIN category AS c WHERE i.category_id=c.id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':instrument', $search['category_id'], PDO::PARAM_STR);
        $statement->execute();
        //bindValue(':style', $search['style']);


        // if ($orderBy) {
        //     $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        // }

        return $this->pdo->query($query)->fetchAll();
    }
}

