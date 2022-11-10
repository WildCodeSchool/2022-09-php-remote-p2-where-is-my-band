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
        $query = 'SELECT * FROM band AS b JOIN localisation AS l ON b.localisation_id=l.id
        JOIN search_instrument AS s_i ON b.id=s_i.band_id WHERE b.localisation_id=:localisation
        AND s_i.instrument_id=:instrument';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':localisation', $search['localisation'], PDO::PARAM_INT);
        $statement->bindValue(':instrument', $search['instrument'], PDO::PARAM_INT);
        $statement->execute();


        //bindValue(':style', $search['style']);


        // if ($orderBy) {
        //     $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        // }

        return $this->pdo->query($query)->fetchAll();
    }
}
