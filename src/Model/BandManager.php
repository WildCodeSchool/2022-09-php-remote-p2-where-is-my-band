<?php

namespace App\Model;

use PDO;

class BandManager extends AbstractManager
{
    public const TABLE = 'band';

    public function selectAllByQuery(array $search): array
    {

        $query = 'SELECT b.*, i.name AS instrumentName, l.region, s_i.level, s_i.description AS annonce, b.style 
        FROM band AS b
        JOIN localisation AS l ON b.localisation_id=l.id
        JOIN search_instrument AS s_i ON b.id=s_i.band_id
        JOIN instrument AS i ON i.id=s_i.instrument_id';

        $this->searchCondition($query, $search);

        $statement = $this->pdo->prepare($query);
        if (!empty($search['localisation'])) {
            $statement->bindValue(':localisation', $search['localisation'], PDO::PARAM_INT);
        }
        if (!empty($search['instrument'])) {
            $statement->bindValue(':instrument', $search['instrument'], PDO::PARAM_INT);
        }
        if (!empty($search['level'])) {
            $statement->bindValue(':level', $search['level'], PDO::PARAM_STR);
        }
        if (!empty($search['style'])) {
            $statement->bindValue(':style', $search['style'], PDO::PARAM_STR);
        }
        $statement->execute();

        return $statement->fetchAll();
    }

    private function searchCondition(string &$query, array $search): void
    {
        if (!empty($search)) {
            $query .= ' WHERE ';
            $queryArray = [];
            if (!empty($search['localisation'])) {
                $queryArray [] = 'b.localisation_id=:localisation';
            }
            if (!empty($search['instrument'])) {
                $queryArray [] = 's_i.instrument_id=:instrument';
            }
            if (!empty($search['level'])) {
                $queryArray [] = 's_i.level=:level';
            }
            if (!empty($search['style'])) {
                $queryArray [] = 'b.style=:style';
            }
            $query .= implode(' AND ', $queryArray);
        }
    }
}
