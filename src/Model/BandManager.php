<?php

namespace App\Model;

use PDO;

class BandManager extends AbstractManager
{
    public const TABLE = 'band';

    public function selectAllByQuery(array $search): array
    {
        $query = 'SELECT b.*, i.name
        AS instrumentName, l.region, s_i.level, s_i.description
        AS annonce, b.style
        FROM band AS b
        JOIN localisation AS l ON b.localisation_id=l.id
        JOIN search_instrument AS s_i ON b.id=s_i.band_id
        JOIN instrument AS i ON i.id=s_i.instrument_id
        WHERE b.localisation_id=:localisation
        AND s_i.instrument_id=:instrument
        AND s_i.level=:level
        AND b.style=:style';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':localisation', $search['localisation'], PDO::PARAM_INT);
        $statement->bindValue(':instrument', $search['instrument'], PDO::PARAM_INT);
        $statement->bindValue(':level', $search['level'], PDO::PARAM_STR);
        $statement->bindValue(':style', $search['style'], PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll();
    }
}
